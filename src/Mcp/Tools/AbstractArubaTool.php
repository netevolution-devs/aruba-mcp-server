<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

abstract class AbstractArubaTool implements McpToolInterface
{
    public function __construct(protected ArubaBusinessClient $client) {}

    abstract public function getName(): string;
    abstract public function getDescription(): string;
    abstract public function getInputSchema(): array;
    
    protected function getMethod(): string { return 'GET'; }
    abstract protected function getPath(): string;

    public function execute(array $params): array
    {
        $path = $this->getPath();
        $method = $this->getMethod();
        
        // Sostituzione parametri nel path {paramName}
        foreach ($params as $name => $value) {
            if (str_contains($path, '{' . $name . '}')) {
                $path = str_replace('{' . $name . '}', (string)$value, $path);
                unset($params[$name]);
            }
        }
        
        // Pulizia eventuali parametri opzionali nel path non forniti
        $path = preg_replace('/\{[a-zA-Z0-9_]+\}/', '', $path);
        // Rimuove eventuali slash doppi o finali causati dalla rimozione
        $path = str_replace('//', '/', $path);
        $path = rtrim($path, '/');

        return $this->client->call($method, $path, $params);
    }
}
