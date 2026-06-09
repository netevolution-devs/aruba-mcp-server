<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class PricelistTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->pricelistPricelistGetPriceListTool(),
        ];
    }

    private function pricelistPricelistGetPriceListTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'pricelist_pricelist_getpricelist'; }
            public function getDescription(): string { return 'Get price list'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                    ],
                    'required' => array (
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/pricelist';
                $method = 'GET';

                foreach ($params as $name => $value) {
                    if (str_contains($path, '{' . $name . '}')) {
                        $path = str_replace('{' . $name . '}', (string)$value, $path);
                        unset($params[$name]);
                    }
                }
                $path = preg_replace('/\{[a-zA-Z0-9_]+\}/', '', $path);
                $path = str_replace('//', '/', $path);
                $path = rtrim($path, '/');

                return $this->client->call($method, $path, $params);
            }
        };
    }
}
