<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

class GenericArubaTool extends AbstractArubaTool
{
    public function __construct(
        ArubaBusinessClient $client,
        private readonly string $name,
        private readonly string $description,
        private readonly string $method,
        private readonly string $path,
        private readonly array $inputSchema
    ) {
        parent::__construct($client);
    }

    public function getName(): string { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getInputSchema(): array { return $this->inputSchema; }
    protected function getMethod(): string { return $this->method; }
    protected function getPath(): string { return $this->path; }
}
