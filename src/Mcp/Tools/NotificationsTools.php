<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class NotificationsTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->notificationsNotificationsGetNotificationsByServiceTool(),
            $this->notificationsNotificationsGetNotificationByIdForSwaggerTool(),
            $this->notificationsNotificationsGetNewsTool(),
            $this->notificationsNotificationsGetNumberToBeDeliveredTool(),
            $this->notificationsNotificationsNotificationChangeStatusTool(),
        ];
    }

    private function notificationsNotificationsGetNotificationsByServiceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'notifications_notifications_getnotificationsbyservice'; }
            public function getDescription(): string { return 'Notification list and total details notifications not read by idService and current calling idClient'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idService' => array (
  'type' => 'integer',
  'description' => 'Id of the service',
),
                    ],
                    'required' => array (
  0 => 'idService',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/Notifications/services/{idService}';
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

    private function notificationsNotificationsGetNotificationByIdForSwaggerTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'notifications_notifications_getnotificationbyidforswagger'; }
            public function getDescription(): string { return 'Notification by idNotification and current calling idClient'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idNotification' => array (
  'type' => 'integer',
  'description' => 'Id of the notification',
),
                    ],
                    'required' => array (
  0 => 'idNotification',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/Notifications/{idNotification}';
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

    private function notificationsNotificationsGetNewsTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'notifications_notifications_getnews'; }
            public function getDescription(): string { return 'Get News of type alert broadcast.'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'pageIndex' => array (
  'type' => 'integer',
  'description' => '',
),
                        'pageSize' => array (
  'type' => 'integer',
  'description' => '',
),
                    ],
                    'required' => array (
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/Notifications/News/pageindex/{pageIndex}/pagesize/{pageSize}';
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

    private function notificationsNotificationsGetNumberToBeDeliveredTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'notifications_notifications_getnumbertobedelivered'; }
            public function getDescription(): string { return 'Retrieve the client\'s number of notification to be delivered'; }

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
                $path = '/api/Notifications/ToBeDelivered';
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

    private function notificationsNotificationsNotificationChangeStatusTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'notifications_notifications_notificationchangestatus'; }
            public function getDescription(): string { return 'Change state of specific notification passed as input'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idNotification' => array (
  'type' => 'integer',
  'description' => 'Notification id',
),
                        'state' => array (
  'type' => 'string',
  'description' => 'State to set for the notification',
),
                    ],
                    'required' => array (
  0 => 'idNotification',
  1 => 'state',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/Notifications/Status/{idNotification}/{state}';
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
