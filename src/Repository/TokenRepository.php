<?php

namespace App\Repository;

class TokenRepository
{
    private \PDO $pdo;

    public function __construct(string $dbPath)
    {
        $this->pdo = new \PDO('sqlite:' . $dbPath);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->init();
    }

    private function init(): void
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS aruba_user_tokens (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                mcp_access_token TEXT UNIQUE,
                aruba_access_token TEXT,
                aruba_refresh_token TEXT,
                aruba_expires_at INTEGER,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );

            CREATE TABLE IF NOT EXISTS oauth_codes (
                code TEXT PRIMARY KEY,
                aruba_access_token TEXT,
                aruba_refresh_token TEXT,
                aruba_expires_at INTEGER,
                expires_at INTEGER
            );
        ");
    }

    public function saveCode(string $code, array $arubaTokens): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO oauth_codes (code, aruba_access_token, aruba_refresh_token, aruba_expires_at, expires_at)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $code,
            $arubaTokens['access_token'],
            $arubaTokens['refresh_token'] ?? null,
            time() + ($arubaTokens['expires_in'] ?? 86400),
            time() + 600 // Codice valido 10 minuti
        ]);
    }

    public function getCode(string $code): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM oauth_codes WHERE code = ? AND expires_at > ?");
        $stmt->execute([$code, time()]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($data) {
            $this->pdo->prepare("DELETE FROM oauth_codes WHERE code = ?")->execute([$code]);
            return $data;
        }
        
        return null;
    }

    public function saveTokens(string $mcpToken, array $arubaTokens): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO aruba_user_tokens (mcp_access_token, aruba_access_token, aruba_refresh_token, aruba_expires_at)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([
            $mcpToken,
            $arubaTokens['aruba_access_token'],
            $arubaTokens['aruba_refresh_token'] ?? null,
            $arubaTokens['aruba_expires_at']
        ]);
    }

    public function getTokensByMcpToken(string $mcpToken): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM aruba_user_tokens WHERE mcp_access_token = ?");
        $stmt->execute([$mcpToken]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }
}
