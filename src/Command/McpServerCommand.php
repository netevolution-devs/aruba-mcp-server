<?php

namespace App\Command;

use App\Mcp\McpServer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:mcp-server',
    description: 'Start the Aruba Business MCP server (stdio mode)',
)]
class McpServerCommand extends Command
{
    public function __construct(private readonly McpServer $mcpServer)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('transport', 't', InputOption::VALUE_OPTIONAL, 'Transport mode: stdio', 'stdio');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Disable output buffering for real-time streaming
        if (ob_get_level()) {
            ob_end_flush();
        }

        $this->mcpServer->runStdio();

        return Command::SUCCESS;
    }
}
