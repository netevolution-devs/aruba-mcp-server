<?php

namespace App\Controller;

use App\Mcp\McpServer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

use Psr\Log\LoggerInterface;

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
    private FilesystemAdapter $cache;

    public function __construct(
        private readonly McpServer $mcpServer,
        private readonly LoggerInterface $logger
    ) {
        $this->cache = new FilesystemAdapter('mcp_sessions', 3600);
    }

    /**
     * SSE endpoint: client connects here and keeps the stream open.
     * Server sends back the POST endpoint URL as first event.
     */
    #[Route('/sse', name: 'mcp_sse', methods: ['GET', 'POST'])]
    public function sse(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            return $this->handleMcpPost($request);
        }

        set_time_limit(0);
        $sessionId = bin2hex(random_bytes(16));
        $postUrl   = $request->getSchemeAndHttpHost() . '/mcp/messages?sessionId=' . $sessionId;

        $this->cache->get('mcp_session_' . $sessionId, function (ItemInterface $item) {
            $item->expiresAfter(300);
            return [
                'queue'     => [],
                'connected' => true,
            ];
        });

        $response = new StreamedResponse(function () use ($sessionId, $postUrl) {
            // Disable PHP output buffering
            while (ob_get_level() > 0) {
                ob_end_flush();
            }

            // Send the endpoint event as per MCP SSE spec
            echo "event: endpoint\n";
            echo "data: " . $postUrl . "\n\n";
            
            if (ob_get_level() > 0) {
                ob_flush();
            }
            flush();

            // Keep streaming — poll the session queue for messages
            $timeout = time() + 300; // 5 min max connection

            while (time() < $timeout) {
                $session = $this->cache->get('mcp_session_' . $sessionId, function() { return null; });
                
                if (!$session || !($session['connected'] ?? false)) {
                    break;
                }

                if (!empty($session['queue'])) {
                    $msg = array_shift($session['queue']);
                    
                    // Update session in cache after shift
                    $item = $this->cache->getItem('mcp_session_' . $sessionId);
                    $item->set($session);
                    $this->cache->save($item);

                    echo "event: message\n";
                    echo "data: " . json_encode($msg) . "\n\n";
                    if (ob_get_level() > 0) {
                        ob_flush();
                    }
                    flush();
                }

                usleep(200_000); // 200ms polling
            }

            $this->cache->delete('mcp_session_' . $sessionId);
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache, no-transform');
        $response->headers->set('Connection', 'keep-alive');
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
        return $this->handleMcpPost($request);
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

    private function handleMcpPost(Request $request): Response
    {
        $body = $request->getContent();
        $this->logger->info('MCP Request Body: ' . $body);

        if (!json_validate($body)) {
            return new Response('Invalid JSON', 400);
        }

        $bodyArray = json_decode($body, true);
        $response  = $this->mcpServer->handleRequestPublic($bodyArray);

        // Gestisci anche la sessione SSE se presente
        $sessionId = $request->query->get('sessionId');
        if ($sessionId) {
            $item = $this->cache->getItem('mcp_session_' . $sessionId);
            if ($item->isHit() && $response !== null) {
                $session = $item->get();
                $session['queue'][] = $response;
                $item->set($session);
                $this->cache->save($item);
            }
        }

        if ($response === null) {
            return new Response('', 204);
        }

        return $this->json($response);
    }
}
