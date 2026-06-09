<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class DelegatedUsersTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->delegatedUsersDelegatedUsersGetDelegateUsersTool(),
            $this->delegatedUsersDelegatedUsersGetDelegateUsers0Tool(),
            $this->delegatedUsersDelegatedUsersUpdateDelegateUserTool(),
            $this->delegatedUsersDelegatedUsersInsertDelegateUserStandardTool(),
            $this->delegatedUsersDelegatedUsersInsertDelegateUserLimitedTool(),
            $this->delegatedUsersDelegatedUsersSendNotificationChangePasswordTool(),
            $this->delegatedUsersDelegatedUsersUpdateFlagEnableDelegateUserTool(),
            $this->delegatedUsersDelegatedUsersDisableOtpDelegateUserTool(),
            $this->delegatedUsersDelegatedUsersDisableOtpDelegateUser0Tool(),
            $this->delegatedUsersDelegatedUsersDeleteDelegateUserTool(),
        ];
    }

    private function delegatedUsersDelegatedUsersGetDelegateUsersTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_getdelegateusers'; }
            public function getDescription(): string { return 'Get delegated user details'; }

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
                $path = '/api/delegatedusers/{username}/detail';
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

    private function delegatedUsersDelegatedUsersGetDelegateUsers0Tool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_getdelegateusers_0'; }
            public function getDescription(): string { return 'Get client delegated users'; }

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
                $path = '/api/delegatedusers';
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

    private function delegatedUsersDelegatedUsersUpdateDelegateUserTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_updatedelegateuser'; }
            public function getDescription(): string { return 'Update delegated user'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'delegateUserUpdateInput' => array (
  'type' => 'string',
  'description' => 'delegated user content',
),
                    ],
                    'required' => array (
  0 => 'delegateUserUpdateInput',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/delegatedusers';
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

    private function delegatedUsersDelegatedUsersInsertDelegateUserStandardTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_insertdelegateuserstandard'; }
            public function getDescription(): string { return 'Add new delegated standard user'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'delegateuser' => array (
  'type' => 'boolean',
  'description' => 'delegated user content',
),
                    ],
                    'required' => array (
  0 => 'delegateuser',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/delegatedusers/standard';
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

    private function delegatedUsersDelegatedUsersInsertDelegateUserLimitedTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_insertdelegateuserlimited'; }
            public function getDescription(): string { return 'Add new delegated limited user'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'delegateuser' => array (
  'type' => 'boolean',
  'description' => 'delegated limited user content',
),
                    ],
                    'required' => array (
  0 => 'delegateuser',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/delegatedusers/limited';
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

    private function delegatedUsersDelegatedUsersSendNotificationChangePasswordTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_sendnotificationchangepassword'; }
            public function getDescription(): string { return 'Send to delegated user email for change password'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'delegateUserChangePasswordInput' => array (
  'type' => 'string',
  'description' => 'delegated user content',
),
                    ],
                    'required' => array (
  0 => 'delegateUserChangePasswordInput',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/delegatedusers/ChangePassword/email';
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

    private function delegatedUsersDelegatedUsersUpdateFlagEnableDelegateUserTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_updateflagenabledelegateuser'; }
            public function getDescription(): string { return 'Enable-Disable delegated user'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'delegateUserEnableInput' => array (
  'type' => 'boolean',
  'description' => 'delegated user content',
),
                    ],
                    'required' => array (
  0 => 'delegateUserEnableInput',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/delegatedusers/Enable';
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

    private function delegatedUsersDelegatedUsersDisableOtpDelegateUserTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_disableotpdelegateuser'; }
            public function getDescription(): string { return 'Disable delegated user OTP'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'delegateUserDisableOTP' => array (
  'type' => 'string',
  'description' => 'delegated username',
),
                    ],
                    'required' => array (
  0 => 'delegateUserDisableOTP',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/delegatedusers/OTP/Disactivate';
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

    private function delegatedUsersDelegatedUsersDisableOtpDelegateUser0Tool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_disableotpdelegateuser_0'; }
            public function getDescription(): string { return 'Update profile standard delegated user'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'delegateUserUpdateProfile' => array (
  'type' => 'string',
  'description' => 'delegated user detail input',
),
                    ],
                    'required' => array (
  0 => 'delegateUserUpdateProfile',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/delegatedusers/profile';
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

    private function delegatedUsersDelegatedUsersDeleteDelegateUserTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'delegatedusers_delegatedusers_deletedelegateuser'; }
            public function getDescription(): string { return 'Delete delegated user'; }

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
                $path = '/api/delegatedusers/{username}/username';
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
}
