<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class TicketsTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->ticketsTicketsGetTicketsClientTool(),
            $this->ticketsTicketsNewTicketTool(),
            $this->ticketsTicketsAddMessageToTicketTool(),
            $this->ticketsTicketsAddAttachmentToMessageTool(),
            $this->ticketsTicketsGetCategoriesTool(),
            $this->ticketsTicketsGetTicketTool(),
            $this->ticketsTicketsGetAttachmentTool(),
        ];
    }

    private function ticketsTicketsGetTicketsClientTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'tickets_tickets_getticketsclient'; }
            public function getDescription(): string { return 'Retrieve list of tickets (paged)'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'filter.page' => array (
  'type' => 'integer',
  'description' => '',
),
                        'filter.status' => array (
  'type' => 'string',
  'description' => '',
),
                        'filter.searchstring' => array (
  'type' => 'string',
  'description' => '',
),
                    ],
                    'required' => array (
  0 => 'filter.page',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/tickets';
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

    private function ticketsTicketsNewTicketTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'tickets_tickets_newticket'; }
            public function getDescription(): string { return 'New ticket'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'newTicketInput' => array (
  'type' => 'integer',
  'description' => 'Ticket details',
),
                    ],
                    'required' => array (
  0 => 'newTicketInput',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/tickets';
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

    private function ticketsTicketsAddMessageToTicketTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'tickets_tickets_addmessagetoticket'; }
            public function getDescription(): string { return 'Add message to ticket'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'messageTicket' => array (
  'type' => 'number',
  'description' => 'Ticket message',
),
                    ],
                    'required' => array (
  0 => 'messageTicket',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/tickets/messages';
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

    private function ticketsTicketsAddAttachmentToMessageTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'tickets_tickets_addattachmenttomessage'; }
            public function getDescription(): string { return 'Add attachment to ticket message'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'Input' => array (
  'type' => 'integer',
  'description' => 'JSON field (serialized)',
),
                        'file' => array (
  'type' => 'string',
  'description' => 'File to upload',
),
                    ],
                    'required' => array (
  0 => 'Input',
  1 => 'file',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/tickets/messages/attachments';
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

    private function ticketsTicketsGetCategoriesTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'tickets_tickets_getcategories'; }
            public function getDescription(): string { return 'Finds all categories that can be associated to a ticket'; }

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
                $path = '/api/tickets/categories';
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

    private function ticketsTicketsGetTicketTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'tickets_tickets_getticket'; }
            public function getDescription(): string { return 'Get ticket details'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'TicketNumber' => array (
  'type' => 'string',
  'description' => '',
),
                    ],
                    'required' => array (
  0 => 'TicketNumber',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/tickets/{TicketNumber}';
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

    private function ticketsTicketsGetAttachmentTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'tickets_tickets_getattachment'; }
            public function getDescription(): string { return 'Retrieves the specified attachment associated with a ticket.'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'TicketNumber' => array (
  'type' => 'string',
  'description' => 'The unique identifier of the ticket to which the attachment belongs. Cannot be null or empty.',
),
                        'AttachmentId' => array (
  'type' => 'string',
  'description' => 'The unique identifier of the attachment to retrieve.',
),
                    ],
                    'required' => array (
  0 => 'TicketNumber',
  1 => 'AttachmentId',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/tickets/{TicketNumber}/attachments/{AttachmentId}';
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
