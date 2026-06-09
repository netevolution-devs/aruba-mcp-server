<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class EndUsersTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->endUsersEndUsersDeleteEndUserTool(),
            $this->endUsersEndUsersGetEndUsersTool(),
            $this->endUsersEndUsersGetEndUsers0Tool(),
            $this->endUsersEndUsersInsertEndUsersTool(),
            $this->endUsersEndUsersUpdateFullEndUserTool(),
        ];
    }

    private function endUsersEndUsersDeleteEndUserTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'endusers_endusers_deleteenduser'; }
            public function getDescription(): string { return 'Delete enduser'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'username' => array (
  'type' => 'string',
  'description' => 'Username',
),
                    ],
                    'required' => array (
  0 => 'username',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/endusers/{username}/username';
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

    private function endUsersEndUsersGetEndUsersTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'endusers_endusers_getendusers'; }
            public function getDescription(): string { return 'Get enduser details'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'username' => array (
  'type' => 'string',
  'description' => 'Username',
),
                    ],
                    'required' => array (
  0 => 'username',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/endusers/{username}/username';
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

    private function endUsersEndUsersGetEndUsers0Tool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'endusers_endusers_getendusers_0'; }
            public function getDescription(): string { return 'Get client endusers'; }

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
                $path = '/api/endusers';
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

    private function endUsersEndUsersInsertEndUsersTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'endusers_endusers_insertendusers'; }
            public function getDescription(): string { return 'Add new enduser'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'enduser' => array (
  'type' => 'integer',
  'description' => 'Enduser content',
),
                    ],
                    'required' => array (
  0 => 'enduser',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/endusers';
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

    private function endUsersEndUsersUpdateFullEndUserTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'endusers_endusers_updatefullenduser'; }
            public function getDescription(): string { return 'Update enduser'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'enduser' => array (
  'type' => 'integer',
  'description' => 'Enduser content',
),
                    ],
                    'required' => array (
  0 => 'enduser',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/endusers';
                $method = 'PUT';

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
