<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class DomainTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->listDomainsTool(),
            $this->getDomainTool(),
            $this->checkAvailabilityTool(),
            $this->getDnsRecordsTool(),
            $this->updateDnsRecordTool(),
            $this->deleteDnsRecordTool(),
            $this->renewDomainTool(),
        ];
    }

    private function listDomainsTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_list_domains'; }
            public function getDescription(): string { return 'Lista tutti i domini registrati nel pannello Aruba Business'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'page'     => ['type' => 'integer', 'description' => 'Pagina (default 1)', 'default' => 1],
                        'pageSize' => ['type' => 'integer', 'description' => 'Risultati per pagina (default 50)', 'default' => 50],
                    ],
                    'required' => [],
                ];
            }

            public function execute(array $params): array {
                return $this->client->listDomains($params['page'] ?? 1, $params['pageSize'] ?? 50);
            }
        };
    }

    private function getDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_get_domain'; }
            public function getDescription(): string { return 'Ottieni dettagli di un dominio specifico (scadenza, stato, nameserver, contatti)'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => ['type' => 'string', 'description' => 'Nome dominio (es. example.com)'],
                    ],
                    'required' => ['domain'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->getDomain($params['domain']);
            }
        };
    }

    private function checkAvailabilityTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_check_domain_availability'; }
            public function getDescription(): string { return 'Verifica se un dominio è disponibile per la registrazione e restituisce il prezzo'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => ['type' => 'string', 'description' => 'Nome dominio da controllare (es. mionuovodominio.it)'],
                    ],
                    'required' => ['domain'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->checkDomainAvailability($params['domain']);
            }
        };
    }

    private function getDnsRecordsTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_get_dns_records'; }
            public function getDescription(): string { return 'Elenca tutti i record DNS di un dominio (A, MX, CNAME, TXT, ecc.)'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => ['type' => 'string', 'description' => 'Nome dominio'],
                    ],
                    'required' => ['domain'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->getDnsRecords($params['domain']);
            }
        };
    }

    private function updateDnsRecordTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_update_dns_record'; }
            public function getDescription(): string { return 'Aggiunge o modifica un record DNS di un dominio'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => ['type' => 'string', 'description' => 'Nome dominio'],
                        'type'   => ['type' => 'string', 'enum' => ['A', 'AAAA', 'CNAME', 'MX', 'TXT', 'NS', 'SRV'], 'description' => 'Tipo record DNS'],
                        'name'   => ['type' => 'string', 'description' => 'Nome host (es. www, @, mail)'],
                        'value'  => ['type' => 'string', 'description' => 'Valore del record'],
                        'ttl'    => ['type' => 'integer', 'description' => 'TTL in secondi (default 3600)', 'default' => 3600],
                        'priority' => ['type' => 'integer', 'description' => 'Priorità (solo per MX)'],
                    ],
                    'required' => ['domain', 'type', 'name', 'value'],
                ];
            }

            public function execute(array $params): array {
                $domain = $params['domain'];
                unset($params['domain']);
                return $this->client->updateDnsRecord($domain, $params);
            }
        };
    }

    private function deleteDnsRecordTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_delete_dns_record'; }
            public function getDescription(): string { return 'Elimina un record DNS da un dominio'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain'    => ['type' => 'string', 'description' => 'Nome dominio'],
                        'record_id' => ['type' => 'string', 'description' => 'ID del record DNS da eliminare'],
                    ],
                    'required' => ['domain', 'record_id'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->deleteDnsRecord($params['domain'], $params['record_id']);
            }
        };
    }

    private function renewDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_renew_domain'; }
            public function getDescription(): string { return 'Rinnova un dominio per uno o più anni'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => ['type' => 'string', 'description' => 'Nome dominio da rinnovare'],
                        'years'  => ['type' => 'integer', 'description' => 'Anni di rinnovo (default 1)', 'default' => 1],
                    ],
                    'required' => ['domain'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->renewDomain($params['domain'], $params['years'] ?? 1);
            }
        };
    }
}
