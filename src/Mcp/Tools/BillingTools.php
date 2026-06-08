<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class BillingTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->getPriceListTool(),
            $this->listOrdersTool(),
            $this->getOrderTool(),
            $this->listInvoicesTool(),
            $this->getInvoiceTool(),
            $this->getAccountBalanceTool(),
        ];
    }

    private function getPriceListTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_get_pricelist'; }
            public function getDescription(): string { return 'Ottieni il listino prezzi Aruba Business per tutti i servizi (domini, hosting, email)'; }
            public function getInputSchema(): array { return ['type' => 'object', 'properties' => []]; }

            public function execute(array $params): array {
                return $this->client->getPriceList();
            }
        };
    }

    private function listOrdersTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_list_orders'; }
            public function getDescription(): string { return 'Lista gli ordini Aruba Business con filtri opzionali per stato e data'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'status'   => ['type' => 'string', 'enum' => ['pending', 'completed', 'cancelled', 'processing'], 'description' => 'Filtra per stato ordine'],
                        'dateFrom' => ['type' => 'string', 'description' => 'Data inizio (YYYY-MM-DD)'],
                        'dateTo'   => ['type' => 'string', 'description' => 'Data fine (YYYY-MM-DD)'],
                    ],
                ];
            }

            public function execute(array $params): array {
                return $this->client->listOrders(array_filter($params));
            }
        };
    }

    private function getOrderTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_get_order'; }
            public function getDescription(): string { return 'Dettagli di un ordine specifico Aruba Business tramite ID'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'order_id' => ['type' => 'string', 'description' => 'ID ordine'],
                    ],
                    'required' => ['order_id'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->getOrder($params['order_id']);
            }
        };
    }

    private function listInvoicesTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_list_invoices'; }
            public function getDescription(): string { return 'Lista le fatture Aruba Business con filtri per data e stato'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'dateFrom' => ['type' => 'string', 'description' => 'Data inizio (YYYY-MM-DD)'],
                        'dateTo'   => ['type' => 'string', 'description' => 'Data fine (YYYY-MM-DD)'],
                        'status'   => ['type' => 'string', 'enum' => ['paid', 'unpaid', 'overdue'], 'description' => 'Stato fattura'],
                    ],
                ];
            }

            public function execute(array $params): array {
                return $this->client->listInvoices(array_filter($params));
            }
        };
    }

    private function getInvoiceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_get_invoice'; }
            public function getDescription(): string { return 'Dettagli di una fattura Aruba Business tramite ID'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'invoice_id' => ['type' => 'string', 'description' => 'ID fattura'],
                    ],
                    'required' => ['invoice_id'],
                ];
            }

            public function execute(array $params): array {
                return $this->client->getInvoice($params['invoice_id']);
            }
        };
    }

    private function getAccountBalanceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'aruba_get_account_balance'; }
            public function getDescription(): string { return 'Verifica il saldo e il credito disponibile nel tuo account Aruba Business'; }
            public function getInputSchema(): array { return ['type' => 'object', 'properties' => []]; }

            public function execute(array $params): array {
                return $this->client->getAccountBalance();
            }
        };
    }
}
