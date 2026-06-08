<?php

namespace App\Controller;

use App\Mcp\McpServer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Attribute\Route;

/**
 * HTTP + SSE transport for MCP.
 *
 * The MCP SSE transport uses two endpoints:
 *   GET  /mcp/sse      → opens SSE stream, sends endpoint URL
 *   POST /mcp/messages → receives JSON-RPC requests, replies via SSE stream
 *
 * For multi-user support each session gets a unique ID.
 */
#[Route('/mcp')]
class McpController extends AbstractController
{
    // Simple in-process session store (use Redis/APCu in production)
    private static array $sessions = [];

    public function __construct(private readonly McpServer $mcpServer) {}

    /**
     * SSE endpoint: client connects here and keeps the stream open.
     * Server sends back the POST endpoint URL as first event.
     */
    #[Route('/sse', name: 'mcp_sse', methods: ['GET'])]
    public function sse(Request $request): StreamedResponse
    {
        $sessionId = bin2hex(random_bytes(16));
        $postUrl   = $request->getSchemeAndHttpHost() . '/mcp/messages?sessionId=' . $sessionId;

        self::$sessions[$sessionId] = [
            'queue'     => [],
            'connected' => true,
        ];

        $response = new StreamedResponse(function () use ($sessionId, $postUrl) {
            // Send the endpoint event as per MCP SSE spec
            echo "event: endpoint\n";
            echo "data: " . $postUrl . "\n\n";
            flush();

            // Keep streaming — poll the session queue for messages
            $timeout = time() + 300; // 5 min max connection

            while (time() < $timeout && (self::$sessions[$sessionId]['connected'] ?? false)) {
                if (!empty(self::$sessions[$sessionId]['queue'])) {
                    $msg = array_shift(self::$sessions[$sessionId]['queue']);
                    echo "event: message\n";
                    echo "data: " . json_encode($msg) . "\n\n";
                    flush();
                }

                usleep(100_000); // 100ms polling
            }

            unset(self::$sessions[$sessionId]);
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('X-Accel-Buffering', 'no'); // disable nginx buffering

        return $response;
    }

    /**
     * Message endpoint: client POSTs JSON-RPC requests here.
     * We process them and push the response onto the SSE stream.
     */
    #[Route('/messages', name: 'mcp_messages', methods: ['POST'])]
    public function messages(Request $request): Response
    {
        $sessionId = $request->query->get('sessionId');

        if (!$sessionId || !isset(self::$sessions[$sessionId])) {
            return new Response('Session not found', 404);
        }

        $body = $request->getContent();
        if (!json_validate($body)) {
            return new Response('Invalid JSON', 400);
        }

        $bodyArray = json_decode($body, true);

        // Process the MCP request
        $response = $this->mcpServer->handleRequestPublic($bodyArray);

        if ($response !== null) {
            self::$sessions[$sessionId]['queue'][] = $response;
        }

        return new Response('', 202); // Accepted
    }

    /**
     * Health check
     */
    #[Route('/health', name: 'mcp_health', methods: ['GET'])]
    public function health(): Response
    {
        return $this->json([
            'status'  => 'ok',
            'server'  => 'aruba-business-mcp',
            'version' => '1.0.0',
        ]);
    }
}
