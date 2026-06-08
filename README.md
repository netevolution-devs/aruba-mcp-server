# Aruba Business MCP Server (Symfony)

Server MCP per la gestione dei servizi Aruba Business (Domini, Email, Hosting, Fatturazione).

## Requisiti
- PHP 8.3+
- Symfony CLI (opzionale)
- Composer

## Configurazione

Crea un file `.env.local` con i seguenti parametri:

```env
ARUBA_API_KEY="la_tua_api_key"
ARUBA_USERNAME="il_tuo_username"
ARUBA_PASSWORD="la_tua_password"
MCP_AUTH_TOKEN="mcp_live_una_tua_chiave_segreta_lunga"
```

## Installazione

```bash
composer install
```

## Utilizzo

### Login Iniziale
Per ottenere il primo token di accesso:
```bash
php bin/console aruba:login
```

### Avvio Server MCP (Stdio)
```bash
php bin/console app:mcp-server
```

### Avvio Server Web (HTTP/SSE)
```bash
symfony server:start
```
L'endpoint SSE sarà disponibile su `http://localhost:8000/mcp/sse`.
