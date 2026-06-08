<?php

namespace App\Mcp\Tools;

interface McpToolInterface
{
    public function getName(): string;
    public function getDescription(): string;
    public function getInputSchema(): array;

    /** Execute the tool and return the result as array */
    public function execute(array $params): array;
}
