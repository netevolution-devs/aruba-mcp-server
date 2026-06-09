<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class CartsTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->cartsCartsGetCartTool(),
            $this->cartsCartsGetCartsTool(),
            $this->cartsCartsPostCartTool(),
            $this->cartsCartsDeleteCartTool(),
            $this->cartsCartsGetItemTool(),
            $this->cartsCartsAddDomainItemTool(),
            $this->cartsCartsAddTransferItemTool(),
            $this->cartsCartsAddPecItemTool(),
            $this->cartsCartsAddExternalDomainItemTool(),
            $this->cartsCartsAddCloudHostingRAMUpgradeItemTool(),
            $this->cartsCartsAddCloudHostingExtraCPUUpgradeItemTool(),
            $this->cartsCartsDeleteCartItemTool(),
            $this->cartsCartsFinalizeTool(),
            $this->cartsCartsGetRequiredAcceptanceTool(),
            $this->cartsCartsPostRequiredAcceptanceTool(),
        ];
    }

    private function cartsCartsGetCartTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_getcart'; }
            public function getDescription(): string { return 'Get specific client cart'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'id' => array (
  'type' => 'string',
  'description' => 'Cart id',
),
                        'all' => array (
  'type' => 'boolean',
  'description' => 'True to retrieve all details; False otherwise; The default value is False',
),
                    ],
                    'required' => array (
  0 => 'id',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/{id}/{all}';
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

    private function cartsCartsGetCartsTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_getcarts'; }
            public function getDescription(): string { return 'Get client carts'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'all' => array (
  'type' => 'boolean',
  'description' => 'True to retrieve all details; False otherwise; The default value is False',
),
                    ],
                    'required' => array (
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/{all}';
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

    private function cartsCartsPostCartTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_postcart'; }
            public function getDescription(): string { return 'Create new cart'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'string',
  'description' => 'Optional custom id associated to the cart',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts';
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

    private function cartsCartsDeleteCartTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_deletecart'; }
            public function getDescription(): string { return 'Delete cart'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'id' => array (
  'type' => 'string',
  'description' => 'Cart id',
),
                    ],
                    'required' => array (
  0 => 'id',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/{id}';
                $method = 'DELETE';

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

    private function cartsCartsGetItemTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_getitem'; }
            public function getDescription(): string { return 'Get cart item'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'id' => array (
  'type' => 'integer',
  'description' => 'Cart item id',
),
                        'all' => array (
  'type' => 'boolean',
  'description' => 'True to retrieve all details; False otherwise; The default value is False',
),
                    ],
                    'required' => array (
  0 => 'id',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/item/{id}/{all}';
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

    private function cartsCartsAddDomainItemTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_adddomainitem'; }
            public function getDescription(): string { return 'Add domain item to cart'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'boolean',
  'description' => 'Domain item details',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/item/domain';
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

    private function cartsCartsAddTransferItemTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_addtransferitem'; }
            public function getDescription(): string { return 'Add transfer item to cart'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'boolean',
  'description' => 'Domain item details to cart',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/item/transfer';
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

    private function cartsCartsAddPecItemTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_addpecitem'; }
            public function getDescription(): string { return 'Add pec item to cart'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'integer',
  'description' => 'pec item details to cart',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/item/pec';
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

    private function cartsCartsAddExternalDomainItemTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_addexternaldomainitem'; }
            public function getDescription(): string { return 'Add external domain item to cart'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'boolean',
  'description' => 'cloud hosting item details to cart',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/item/externalDomain';
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

    private function cartsCartsAddCloudHostingRAMUpgradeItemTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_addcloudhostingramupgradeitem'; }
            public function getDescription(): string { return 'Add Cloud hosting RAM Upgrade to cart, on a existing Cloud hosting plan'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'integer',
  'description' => 'Cloud hosting RAM Upgrade item details to cart',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/item/CloudHostingRAMUpgrade';
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

    private function cartsCartsAddCloudHostingExtraCPUUpgradeItemTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_addcloudhostingextracpuupgradeitem'; }
            public function getDescription(): string { return 'Add Cloud hosting extra CPU Upgrade to cart, on a existing Linux Cloud hosting plan'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'integer',
  'description' => 'Cloud hosting extra CPU Upgrade item details to cart',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/item/CloudHostingExtraCPUUpgrade';
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

    private function cartsCartsDeleteCartItemTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_deletecartitem'; }
            public function getDescription(): string { return 'Delete cart item'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'id' => array (
  'type' => 'integer',
  'description' => 'Cart item id',
),
                    ],
                    'required' => array (
  0 => 'id',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/item/{id}';
                $method = 'DELETE';

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

    private function cartsCartsFinalizeTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_finalize'; }
            public function getDescription(): string { return 'Finalize cart'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idCart' => array (
  'type' => 'string',
  'description' => 'Cart id',
),
                        'idSubscription' => array (
  'type' => 'string',
  'description' => 'Submit acceptances reference id',
),
                    ],
                    'required' => array (
  0 => 'idCart',
  1 => 'idSubscription',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/finalize/{idCart}/{idSubscription}';
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

    private function cartsCartsGetRequiredAcceptanceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_getrequiredacceptance'; }
            public function getDescription(): string { return 'Get required acceptances list to finalize cart'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'id' => array (
  'type' => 'string',
  'description' => 'Cart id',
),
                    ],
                    'required' => array (
  0 => 'id',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/acceptances/{id}';
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

    private function cartsCartsPostRequiredAcceptanceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'carts_carts_postrequiredacceptance'; }
            public function getDescription(): string { return 'Set subscription contracts'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'modelAcceptance' => array (
  'type' => 'boolean',
  'description' => 'Submit acceptances',
),
                    ],
                    'required' => array (
  0 => 'modelAcceptance',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/carts/acceptances';
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
