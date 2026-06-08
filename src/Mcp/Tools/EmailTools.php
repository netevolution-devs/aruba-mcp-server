<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class EmailTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->listMailboxesTool(),
            $this->createMailboxTool(),
            $this->updateMailboxTool(),
            $this->deleteMailboxTool(),
            $this->listPecTool(),
        ];
    }

    private function listMailboxesTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_list_mailboxes'; }
            public function getDescription(): string { return 'Elenca le caselle email associate a un dominio Aruba Business'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => ['type' => 'string', 'description' => 'Dominio (es. example.com). Lascia vuoto per tutti.'],
                    ],
                ];
            }

            public function execute(array $params): array {
                return $this->client->listMailboxes($params['domain'] ?? '');
            }
        };
    }

    private function createMailboxTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_create_mailbox'; }
            public function getDescription(): string { return 'Crea una nuova casella email su un dominio Aruba Business'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'email'       => ['type' => 'string', 'description' => 'Indirizzo email completo (es. info@example.com)'],
                        'password'    => ['type' => 'string', 'description' => 'Password della casella'],
                        'displayName' => ['type' => 'string', 'description' => 'Nome visualizzato'],
                        'quota'       => ['type' => 'integer', 'description' => 'Quota in MB (default: quota del piano)'],
                    ],
                    'required' => ['email', 'password'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->createMailbox($params);
            }
        };
    }

    private function updateMailboxTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_update_mailbox'; }
            public function getDescription(): string { return 'Aggiorna i parametri di una casella email (password, quota, displayName)'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'email'       => ['type' => 'string', 'description' => 'Indirizzo email da aggiornare'],
                        'password'    => ['type' => 'string', 'description' => 'Nuova password (opzionale)'],
                        'displayName' => ['type' => 'string', 'description' => 'Nuovo nome visualizzato (opzionale)'],
                        'quota'       => ['type' => 'integer', 'description' => 'Nuova quota in MB (opzionale)'],
                    ],
                    'required' => ['email'],
                ];
            }

            public function execute(array $params): array {
                $email = $params['email'];
                unset($params['email']);
                return $this->client->updateMailbox($email, $params);
            }
        };
    }

    private function deleteMailboxTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_delete_mailbox'; }
            public function getDescription(): string { return 'Elimina una casella email da Aruba Business'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'email' => ['type' => 'string', 'description' => 'Indirizzo email da eliminare'],
                    ],
                    'required' => ['email'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->deleteMailbox($params['email']);
            }
        };
    }

    private function listPecTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_list_pec'; }
            public function getDescription(): string { return 'Elenca le caselle PEC (Posta Elettronica Certificata) nel pannello Aruba Business'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => ['type' => 'string', 'description' => 'Filtra per dominio (opzionale)'],
                    ],
                ];
            }

            public function execute(array $params): array {
                return $this->client->listPec($params['domain'] ?? '');
            }
        };
    }
}
