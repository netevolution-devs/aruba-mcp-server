<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class HostingTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->listHostingTool(),
            $this->getHostingTool(),
            $this->getHostingStatsTool(),
            $this->listServersTool(),
            $this->getServerTool(),
        ];
    }

    private function listHostingTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_list_hosting'; }
            public function getDescription(): string { return 'Lista tutti i servizi hosting attivi nel pannello Aruba Business'; }
            public function getInputSchema(): array { return ['type' => 'object', 'properties' => []]; }

            public function execute(array $params): array {
                return $this->client->listHostingServices();
            }
        };
    }

    private function getHostingTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_get_hosting'; }
            public function getDescription(): string { return 'Dettagli di un servizio hosting Aruba Business (piano, scadenza, FTP, DB)'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'service_id' => ['type' => 'string', 'description' => 'ID del servizio hosting'],
                    ],
                    'required' => ['service_id'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->getHostingService($params['service_id']);
            }
        };
    }

    private function getHostingStatsTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_get_hosting_stats'; }
            public function getDescription(): string { return 'Statistiche di utilizzo di un hosting Aruba (spazio disco, traffico, database)'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'service_id' => ['type' => 'string', 'description' => 'ID del servizio hosting'],
                    ],
                    'required' => ['service_id'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->getHostingStats($params['service_id']);
            }
        };
    }

    private function listServersTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_list_servers'; }
            public function getDescription(): string { return 'Lista i server dedicati o VPS nel pannello Aruba Business'; }
            public function getInputSchema(): array { return ['type' => 'object', 'properties' => []]; }

            public function execute(array $params): array {
                return $this->client->listServers();
            }
        };
    }

    private function getServerTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_get_server'; }
            public function getDescription(): string { return 'Dettagli di un server dedicato o VPS Aruba Business'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'server_id' => ['type' => 'string', 'description' => 'ID del server'],
                    ],
                    'required' => ['server_id'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->getServer($params['server_id']);
            }
        };
    }
}
