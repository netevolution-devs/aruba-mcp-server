<?php

namespace App\Mcp;

use App\Mcp\Tools\McpToolInterface;
use App\Mcp\Tools\DomainTools;
use App\Mcp\Tools\EmailTools;
use App\Mcp\Tools\HostingTools;
use App\Mcp\Tools\BillingTools;
use Psr\Log\LoggerInterface;

/**
 * MCP Server implementing the Model Context Protocol (JSON-RPC 2.0 over stdio).
 * Spec: https://spec.modelcontextprotocol.io
 */
class McpServer
{
    private const  PROTOCOL_VERSION = '2024-11-05';
    private const  SERVER_NAME      = 'aruba-business-mcp';
    private const  SERVER_VERSION   = '1.0.0';

    /** @var McpToolInterface[] indexed by name */
    private array $tools;

    public function __construct(
        private DomainTools  $domainTools,
        private EmailTools   $emailTools,
        private HostingTools $hostingTools,
        private BillingTools $billingTools,
        private LoggerInterface $logger,
    ) {
        $this->tools = [];
        $this->registerTools();
    }

    private function registerTools(): void
    {
        $all = array_merge(
            $this->domainTools->getAll(),
            $this->emailTools->getAll(),
            $this->hostingTools->getAll(),
            $this->billingTools->getAll(),
        );

        foreach ($all as $tool) {
            $this->tools[$tool->getName()] = $tool;
        }
    }

    // ──────────────────────────────────────────────
    // STDIO TRANSPORT
    // ──────────────────────────────────────────────

    public function runStdio(): void
    {
        $this->logger->info('Aruba Business MCP Server started (stdio)');

        $stdin = fopen('php://stdin', 'r');

        while (!feof($stdin)) {
            $line = fgets($stdin);
            if ($line === false || trim($line) === '') {
                continue;
            }

            try {
                if (!json_validate(trim($line))) {
                    $this->writeStdout($this->errorResponse(null, -32700, 'Parse error: Invalid JSON'));
                    continue;
                }
                $request  = json_decode(trim($line), true, 512, JSON_THROW_ON_ERROR);
                $response = $this->handleRequest($request);

                if ($response !== null) {
                    $this->writeStdout($response);
                }
            } catch (\JsonException $e) {
                $this->writeStdout($this->errorResponse(null, -32700, 'Parse error: ' . $e->getMessage()));
            } catch (\Throwable $e) {
                $this->logger->error('MCP error', ['error' => $e->getMessage()]);
                $this->writeStdout($this->errorResponse(null, -32603, 'Internal error: ' . $e->getMessage()));
            }
        }
    }

    private function writeStdout(array $data): void
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
        flush();
    }

    // ──────────────────────────────────────────────
    // JSON-RPC DISPATCHER
    // ──────────────────────────────────────────────

    public function handleRequestPublic(array $request): ?array
    {
        return $this->handleRequest($request);
    }

    private function handleRequest(array $request): ?array
    {
        $id     = $request['id'] ?? null;
        $method = $request['method'] ?? null;
        $params = $request['params'] ?? [];

        return match ($method) {
            'initialize'          => $this->handleInitialize($id, $params),
            'notifications/initialized' => null,
            'initialized'         => null,
            'tools/list'          => $this->handleToolsList($id),
            'tools/call'          => $this->handleToolsCall($id, $params),
            'logging/setLevel'    => $this->successResponse($id, []),
            'ping'                => $this->successResponse($id, []),
            default               => $this->errorResponse($id, -32601, "Method not found: $method"),
        };
    }

    private function handleInitialize(mixed $id, array $params): array
    {
        return $this->successResponse($id, [
            'protocolVersion' => self::PROTOCOL_VERSION,
            'capabilities'    => [
                'tools' => [
                    'listChanged' => true,
                ],
            ],
            'serverInfo' => [
                'name'    => self::SERVER_NAME,
                'version' => self::SERVER_VERSION,
            ],
            'instructions' => 'Server MCP per la gestione di Aruba Business. I tool permettono di gestire domini, DNS, email, hosting e fatturazione.',
        ]);
    }

    private function handleToolsList(mixed $id): array
    {
        $toolList = [];

        foreach ($this->tools as $tool) {
            $schema = $this->normalizeInputSchema($tool->getInputSchema());

            $toolList[] = [
                'name'        => $tool->getName(),
                'description' => $tool->getDescription(),
                'inputSchema' => $schema,
            ];
        }

        return $this->successResponse($id, ['tools' => $toolList]);
    }

    private function normalizeInputSchema(array $schema): array
    {
        if ($schema === []) {
            return [
                'type' => 'object',
                'properties' => (object)[],
                'required' => [],
            ];
        }

        $schema['type'] ??= 'object';

        if (!array_key_exists('properties', $schema)) {
            $schema['properties'] = (object)[];
        }

        if ($schema['properties'] === []) {
            $schema['properties'] = (object)[];
        }

        if (!array_key_exists('required', $schema)) {
            $schema['required'] = [];
        }

        return $schema;
    }

    private function handleToolsCall(mixed $id, array $params): array
    {
        $toolName  = $params['name'] ?? null;
        $arguments = $params['arguments'] ?? [];

        if (!$toolName || !isset($this->tools[$toolName])) {
            return $this->errorResponse($id, -32602, "Tool not found: $toolName");
        }

        try {
            $result = $this->tools[$toolName]->execute($arguments);

            return $this->successResponse($id, [
                'content' => [
                    [
                        'type' => 'text',
                        'text' => json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
                    ],
                ],
                'isError' => false,
            ]);
        } catch (\Throwable $e) {
            $this->logger->error("Tool $toolName failed", ['error' => $e->getMessage()]);

            return $this->successResponse($id, [
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Errore: ' . $e->getMessage(),
                    ],
                ],
                'isError' => true,
            ]);
        }
    }

    // ──────────────────────────────────────────────
    // RESPONSE HELPERS
    // ──────────────────────────────────────────────

    private function successResponse(mixed $id, array $result): array
    {
        return [
            'jsonrpc' => '2.0',
            'id'      => $id,
            'result'  => empty($result) ? (object)[] : $result,
        ];
    }

    private function errorResponse(mixed $id, int $code, string $message): array
    {
        return [
            'jsonrpc' => '2.0',
            'id'      => $id,
            'error'   => ['code' => $code, 'message' => $message],
        ];
    }
}
