<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class OrdersTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->ordersOrdersGetOrdersTool(),
            $this->ordersOrdersGetOrderByIdTool(),
            $this->ordersOrdersGetPaymentMethodsTool(),
            $this->ordersOrdersPayOrderTool(),
        ];
    }

    private function ordersOrdersGetOrdersTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'orders_orders_getorders'; }
            public function getDescription(): string { return 'Get client orders'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'year' => array (
  'type' => 'integer',
  'description' => 'Year - parameter required, integer of the year',
),
                        'month' => array (
  'type' => 'integer',
  'description' => 'Month - parameter required, integer of the month',
),
                    ],
                    'required' => array (
  0 => 'year',
  1 => 'month',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/orders/{year}/{month}';
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

    private function ordersOrdersGetOrderByIdTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'orders_orders_getorderbyid'; }
            public function getDescription(): string { return 'Get order by ordercode'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'companyId' => array (
  'type' => 'string',
  'description' => 'Company id - part of the ordercode',
),
                        'year' => array (
  'type' => 'integer',
  'description' => 'Year - part of the ordercode',
),
                        'id' => array (
  'type' => 'integer',
  'description' => 'Id - part of the ordercode',
),
                        'loadRow' => array (
  'type' => 'boolean',
  'description' => 'True to retrieve also item rows; False otherwise; default value is False',
),
                    ],
                    'required' => array (
  0 => 'companyId',
  1 => 'year',
  2 => 'id',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/orders/{companyId}/{year}/{id}/detail/{loadRow}';
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

    private function ordersOrdersGetPaymentMethodsTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'orders_orders_getpaymentmethods'; }
            public function getDescription(): string { return 'Get list of registered payment methods for the client'; }

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
                $path = '/api/orders/payment/methods';
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

    private function ordersOrdersPayOrderTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'orders_orders_payorder'; }
            public function getDescription(): string { return 'Execute payment order passing order unique identifier and payment method type id'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'payOrder' => array (
  'type' => 'integer',
  'description' => 'Order details',
),
                    ],
                    'required' => array (
  0 => 'payOrder',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/orders/payment';
                $method = 'POST';

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
