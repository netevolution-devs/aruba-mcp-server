<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Client for the Aruba Business REST API.
 *
 * Auth: OAuth2 "password grant" via POST /auth/token
 *   Content-Type: application/x-www-form-urlencoded
 *   Body: grant_type=password&username=...&password=...
 *   Header: Authorization-Key: <apiKey>
 *
 * Subsequent calls:
 *   Header: Authorization: Bearer <access_token>
 *   Header: Authorization-Key: <apiKey>
 *
 * Token persistence: var/aruba_tokens.json — survives MCP stdio restarts.
 *
 * Priority order:
 *   1. Valid token in var/aruba_tokens.json → use it directly
 *   2. Token expired + refresh_token present → POST /auth/token/refresh
 *   3. Refresh expired / missing → POST /auth/token (password grant)
 */
class ArubaBusinessClient
{
    private const string HOST        = 'https://api.arubabusiness.it';
    private const string TOKEN_FILE  = __DIR__ . '/../../var/aruba_tokens.json';
    private const int    TOKEN_TTL   = 3500; // seconds (slightly under real TTL)

    private ?string $accessToken  = null;
    private ?string $refreshToken = null;
    private int     $tokenExpiry  = 0;

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $apiKey,
        private readonly string $username,
        private readonly string $password,
        private readonly ?LoggerInterface $logger = null,
    ) {
        $this->loadTokens();
    }

    // ──────────────────────────────────────────────
    // TOKEN PERSISTENCE
    // ──────────────────────────────────────────────

    private function loadTokens(): void
    {
        if (!file_exists(self::TOKEN_FILE)) {
            return;
        }

        try {
            $json = file_get_contents(self::TOKEN_FILE);
            if (!json_validate($json)) {
                return;
            }
            $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
            $this->accessToken  = $data['access_token']  ?? null;
            $this->refreshToken = $data['refresh_token'] ?? null;
            $this->tokenExpiry  = $data['expires_at']    ?? 0;
        } catch (\Throwable) {
            // Corrupt file — will re-authenticate
        }
    }

    private function saveTokens(): void
    {
        $dir = dirname(self::TOKEN_FILE);
        if (!is_dir($dir)) {
            mkdir($dir, 0750, true);
        }

        file_put_contents(self::TOKEN_FILE, json_encode([
            'access_token'  => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'expires_at'    => $this->tokenExpiry,
        ], JSON_PRETTY_PRINT));
    }

    // ──────────────────────────────────────────────
    // AUTH FLOWS
    // ──────────────────────────────────────────────

    /**
     * Full login: POST /auth/token  (OAuth2 password grant)
     * Matches exactly the Conf.php AcquireToken() logic.
     */
    public function authenticate(): void
    {
        $this->logger?->info('ArubaBusinessClient: authenticating (password grant)');

        $response = $this->httpClient->request('POST', self::HOST . '/auth/token', [
            'headers' => [
                'Content-Type'      => 'application/x-www-form-urlencoded',
                'Authorization-Key' => $this->apiKey,
            ],
            'body' => http_build_query([
                'grant_type' => 'password',
                'username'   => $this->username,
                'password'   => $this->password,
            ]),
        ]);

        $this->storeTokenResponse($response->toArray());
    }

    /**
     * Refresh: POST /auth/token/refresh
     * Falls back to full login if refresh token is rejected.
     */
    public function refreshAccessToken(): void
    {
        if (!$this->refreshToken) {
            $this->authenticate();
            return;
        }

        $this->logger?->info('ArubaBusinessClient: refreshing access token');

        $response   = $this->httpClient->request('POST', self::HOST . '/auth/token/refresh', [
            'headers' => [
                'Content-Type'      => 'application/x-www-form-urlencoded',
                'Authorization-Key' => $this->apiKey,
            ],
            'body' => http_build_query([
                'grant_type'    => 'refresh_token',
                'refresh_token' => $this->refreshToken,
            ]),
        ]);

        if ($response->getStatusCode() >= 400) {
            $this->logger?->warning('ArubaBusinessClient: refresh failed, falling back to password grant');
            $this->refreshToken = null;
            $this->authenticate();
            return;
        }

        $this->storeTokenResponse($response->toArray());
    }

    private function storeTokenResponse(array $data): void
    {
        $this->accessToken  = $data['access_token']  ?? throw new \RuntimeException('No access_token in response: ' . json_encode($data));
        $this->refreshToken = $data['refresh_token'] ?? $this->refreshToken;
        $expiresIn          = (int) ($data['expires_in'] ?? self::TOKEN_TTL);
        $this->tokenExpiry  = time() + $expiresIn;

        $this->saveTokens();

        $this->logger?->info(sprintf('ArubaBusinessClient: token stored, expires in %ds', $expiresIn));
    }

    private function ensureValidToken(): void
    {
        if ($this->accessToken && time() < $this->tokenExpiry) {
            return; // still valid
        }

        if ($this->refreshToken) {
            $this->refreshAccessToken();
        } else {
            $this->authenticate();
        }
    }

    // ──────────────────────────────────────────────
    // CORE HTTP — matches Conf.php GetHeader() exactly
    // ──────────────────────────────────────────────

    private function getHeaders(): array
    {
        $this->ensureValidToken();

        return [
            'Content-Type'      => 'application/json',
            'Authorization'     => 'Bearer ' . $this->accessToken,   // NOTE: capital B, matches Conf.php
            'Authorization-Key' => $this->apiKey,
        ];
    }

    public function get(string $path, array $query = []): array
    {
        return $this->request('GET', $path, ['query' => array_filter($query, fn($v) => $v !== null && $v !== '')]);
    }

    public function post(string $path, array $body = []): array
    {
        return $this->request('POST', $path, ['json' => $body]);
    }

    public function put(string $path, array $body = []): array
    {
        return $this->request('PUT', $path, ['json' => $body]);
    }

    public function delete(string $path): array
    {
        return $this->request('DELETE', $path);
    }

    private function request(string $method, string $path, array $options = [], bool $retried = false): array
    {
        $options['headers'] = $this->getHeaders();

        $url      = self::HOST . $path;
        $response = $this->httpClient->request($method, $url, $options);
        $status   = $response->getStatusCode();

        // Auto-retry once on 401 (token may have been invalidated server-side)
        if ($status === 401 && !$retried) {
            $this->logger?->info('ArubaBusinessClient: 401 on request, forcing token refresh');
            $this->accessToken = null;
            $this->tokenExpiry = 0;
            $this->ensureValidToken();
            return $this->request($method, $path, $options, retried: true);
        }

        return $response->toArray(false);
    }

    // ──────────────────────────────────────────────
    // PUBLIC TOKEN HELPERS
    // ──────────────────────────────────────────────


    /**
     * Login with explicit credentials (used by aruba:login command).
     */
    public function authenticateWith(string $username, string $password): void
    {
        $this->logger?->info('ArubaBusinessClient: authenticating with provided credentials');

        $response = $this->httpClient->request('POST', self::HOST . '/auth/token', [
            'headers' => [
                'Content-Type'      => 'application/x-www-form-urlencoded',
                'Authorization-Key' => $this->apiKey,
            ],
            'body' => http_build_query([
                'grant_type' => 'password',
                'username'   => $username,
                'password'   => $password,
            ]),
        ]);

        $status = $response->getStatusCode();
        if ($status >= 400) {
            $body = $response->getContent(false);
            throw new RuntimeException("Login failed (HTTP $status): $body");
        }

        $this->storeTokenResponse($response->toArray());
    }

    /** Inject tokens from outside (e.g. fetched by another process) */
    public function setTokens(string $accessToken, ?string $refreshToken = null, int $expiresIn = self::TOKEN_TTL): void
    {
        $this->accessToken  = $accessToken;
        $this->refreshToken = $refreshToken ?? $this->refreshToken;
        $this->tokenExpiry  = time() + $expiresIn;
        $this->saveTokens();
    }

    public function getAccessToken(): ?string  { return $this->accessToken; }
    public function getRefreshToken(): ?string { return $this->refreshToken; }
    public function isTokenExpired(): bool     { return !$this->accessToken || time() >= $this->tokenExpiry; }
    public function getTokenExpiresAt(): int   { return $this->tokenExpiry; }

    // ──────────────────────────────────────────────
    // DOMAIN
    // ──────────────────────────────────────────────

    public function listDomains(int $page = 1, int $pageSize = 50): array
    {
        return $this->get('/api/domain', ['page' => $page, 'pageSize' => $pageSize]);
    }

    public function getDomain(string $domain): array
    {
        return $this->get('/api/domain/' . urlencode($domain));
    }

    public function checkDomainAvailability(string $domain): array
    {
        return $this->get('/api/domain/check', ['domain' => $domain]);
    }

    public function registerDomain(array $params): array
    {
        return $this->post('/api/domain', $params);
    }

    public function renewDomain(string $domain, int $years = 1): array
    {
        return $this->post('/api/domain/' . urlencode($domain) . '/renew', ['years' => $years]);
    }

    public function getDnsRecords(string $domain): array
    {
        return $this->get('/api/domain/' . urlencode($domain) . '/dns');
    }

    public function updateDnsRecord(string $domain, array $record): array
    {
        return $this->post('/api/domain/' . urlencode($domain) . '/dns', $record);
    }

    public function deleteDnsRecord(string $domain, string $recordId): array
    {
        return $this->delete('/api/domain/' . urlencode($domain) . '/dns/' . $recordId);
    }

    // ──────────────────────────────────────────────
    // EMAIL / PEC
    // ──────────────────────────────────────────────

    public function listMailboxes(string $domain = ''): array
    {
        return $this->get('/api/email', ['domain' => $domain]);
    }

    public function getMailbox(string $email): array
    {
        return $this->get('/api/email/' . urlencode($email));
    }

    public function createMailbox(array $params): array
    {
        return $this->post('/api/email', $params);
    }

    public function updateMailbox(string $email, array $params): array
    {
        return $this->put('/api/email/' . urlencode($email), $params);
    }

    public function deleteMailbox(string $email): array
    {
        return $this->delete('/api/email/' . urlencode($email));
    }

    public function listPec(string $domain = ''): array
    {
        return $this->get('/api/pec', ['domain' => $domain]);
    }

    // ──────────────────────────────────────────────
    // HOSTING / SERVER
    // ──────────────────────────────────────────────

    public function listHostingServices(): array
    {
        return $this->get('/api/hosting');
    }

    public function getHostingService(string $id): array
    {
        return $this->get('/api/hosting/' . $id);
    }

    public function getHostingStats(string $id): array
    {
        return $this->get('/api/hosting/' . $id . '/stats');
    }

    public function listServers(): array
    {
        return $this->get('/api/server');
    }

    public function getServer(string $id): array
    {
        return $this->get('/api/server/' . $id);
    }

    // ──────────────────────────────────────────────
    // FATTURAZIONE / ORDINI
    // ──────────────────────────────────────────────

    public function getPriceList(): array
    {
        return $this->get('/api/pricelist');
    }

    public function listOrders(array $filters = []): array
    {
        return $this->get('/api/order', $filters);
    }

    public function getOrder(string $id): array
    {
        return $this->get('/api/order/' . $id);
    }

    public function listInvoices(array $filters = []): array
    {
        return $this->get('/api/invoice', $filters);
    }

    public function getInvoice(string $id): array
    {
        return $this->get('/api/invoice/' . $id);
    }

    public function downloadInvoicePdf(string $id): string
    {
        $this->ensureValidToken();
        $response = $this->httpClient->request('GET', self::HOST . '/api/invoice/' . $id . '/pdf', [
            'headers' => $this->getHeaders(),
        ]);
        return $response->getContent();
    }

    public function getAccountBalance(): array
    {
        return $this->get('/api/account/balance');
    }
}
