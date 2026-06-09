<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;
use App\Mcp\Tools\McpToolInterface;

class AuthTools
{
    private const TOKEN_FILE = __DIR__ . '/../../../var/aruba_tokens.json';

    public function __construct(private ArubaBusinessClient $client)
    {
    }

    public function getAll(): array
    {
        return [
            $this->authLoginTool(),
            $this->authLogoutTool(),
            $this->authStatusTool(),
        ];
    }

    private function authLoginTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string
            {
                return 'auth_login';
            }

            public function getDescription(): string
            {
                return 'Effettua il login ad Aruba Business usando username, password e OTP. Salva il token per le chiamate successive.';
            }

            public function getInputSchema(): array
            {
                return [
                    'type' => 'object',
                    'properties' => [
                        'username' => [
                            'type' => 'string',
                            'description' => 'Username Aruba Business (es. user@arubabusiness.it)',
                        ],
                        'password' => [
                            'type' => 'string',
                            'description' => 'Password dell\'account Aruba Business',
                        ],
                        'otp' => [
                            'type' => 'string',
                            'description' => 'Codice OTP generato dall\'app Aruba Business',
                        ],
                    ],
                    'required' => ['username', 'password', 'otp'],
                ];
            }

            public function execute(array $params): array
            {
                try {
                    $tokens = $this->client->authenticateWith(
                        $params['username'],
                        $params['password'],
                        $params['otp']
                    );

                    // Il client salva già i token internamente se configurato, 
                    // ma assicuriamoci che vengano persistiti nel file var/aruba_tokens.json 
                    // come fa ArubaLoginCommand.
                    
                    $expiry = time() + ($tokens['expires_in'] ?? 86400);
                    
                    $tokenData = [
                        'access_token'  => $tokens['access_token'],
                        'refresh_token' => $tokens['refresh_token'] ?? null,
                        'expires_at'    => $expiry,
                    ];

                    $tokenFile = __DIR__ . '/../../../var/aruba_tokens.json';
                    $dir = dirname($tokenFile);
                    if (!is_dir($dir)) {
                        mkdir($dir, 0750, true);
                    }
                    file_put_contents($tokenFile, json_encode($tokenData, JSON_PRETTY_PRINT));

                    return [
                        'content' => [[
                            'type' => 'text',
                            'text' => 'Login effettuato con successo. Il token scade il ' . date('d/m/Y H:i:s', $expiry),
                        ]],
                    ];
                } catch (\Throwable $e) {
                    return [
                        'isError' => true,
                        'content' => [[
                            'type' => 'text',
                            'text' => 'Errore durante il login: ' . $e->getMessage(),
                        ]],
                    ];
                }
            }
        };
    }

    private function authLogoutTool(): McpToolInterface
    {
        return new class() implements McpToolInterface {
            public function getName(): string
            {
                return 'auth_logout';
            }

            public function getDescription(): string
            {
                return 'Effettua il logout eliminando il token memorizzato localmente.';
            }

            public function getInputSchema(): array
            {
                return [
                    'type' => 'object',
                    'properties' => (object)[],
                ];
            }

            public function execute(array $params): array
            {
                $tokenFile = __DIR__ . '/../../../var/aruba_tokens.json';
                if (file_exists($tokenFile)) {
                    unlink($tokenFile);
                    return [
                        'content' => [[
                            'type' => 'text',
                            'text' => 'Logout effettuato. Il token locale è stato eliminato.',
                        ]],
                    ];
                }

                return [
                    'content' => [[
                        'type' => 'text',
                        'text' => 'Nessun token trovato. Sei già disconnesso.',
                    ]],
                ];
            }
        };
    }

    private function authStatusTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string
            {
                return 'auth_status';
            }

            public function getDescription(): string
            {
                return 'Verifica lo stato dell\'autenticazione attuale.';
            }

            public function getInputSchema(): array
            {
                return [
                    'type' => 'object',
                    'properties' => (object)[],
                ];
            }

            public function execute(array $params): array
            {
                $this->client->loadTokens();
                $isExpired = $this->client->isTokenExpired();
                $expiresAt = $this->client->getTokenExpiresAt();

                if (!$this->client->getAccessToken()) {
                    return [
                        'content' => [[
                            'type' => 'text',
                            'text' => 'Non autenticato. Effettua il login con auth_login.',
                        ]],
                    ];
                }

                $status = $isExpired ? 'Scaduto' : 'Valido';
                $expiryStr = $expiresAt > 0 ? date('d/m/Y H:i:s', $expiresAt) : 'Sconosciuta';

                return [
                    'content' => [[
                        'type' => 'text',
                        'text' => sprintf("Stato Token: %s\nScadenza: %s", $status, $expiryStr),
                    ]],
                ];
            }
        };
    }
}
