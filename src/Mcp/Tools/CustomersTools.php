<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class CustomersTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->customersCustomersPasswordTool(),
        ];
    }

    private function customersCustomersPasswordTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'customers_customers_password'; }
            public function getDescription(): string { return 'Change client password'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'newPassword' => array (
  'type' => 'string',
  'description' => 'New password',
),
                    ],
                    'required' => array (
  0 => 'newPassword',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/customers/password';
                $method = 'PATCH';

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
