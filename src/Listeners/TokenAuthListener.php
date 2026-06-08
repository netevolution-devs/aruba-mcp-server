<?php

namespace App\Listeners;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsEventListener(event: 'kernel.request', priority: 10)]
class TokenAuthListener
{
    public function __construct(
        #[Autowire(env: 'MCP_AUTH_TOKEN')]
        private readonly string $mcpAuthToken
    ) {}

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();
        $path = $request->getPathInfo();

        // Controlla solo le rotte MCP
        if (!str_starts_with($path, '/mcp/')) {
            return;
        }

        // Permetti l'accesso alla rotta health senza token (opzionale, ma utile)
        if ($path === '/mcp/health') {
            return;
        }

        $authHeader = $request->headers->get('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            throw new UnauthorizedHttpException('Bearer', 'Missing or invalid Authorization header');
        }

        $token = substr($authHeader, 7);

        if ($token !== $this->mcpAuthToken) {
            throw new UnauthorizedHttpException('Bearer', 'Invalid authentication token');
        }
    }
}
