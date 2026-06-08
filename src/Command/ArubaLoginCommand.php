<?php

namespace App\Command;

use App\Service\ArubaBusinessClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Interactive login command.
 *
 * Chiede username e password, chiama POST /auth/token (grant_type=password)
 * e salva i token in var/aruba_tokens.json.
 *
 * Usare quando:
 *   - Prima configurazione
 *   - Il token è scaduto (validità 24 ore)
 *
 * Usage:
 *   php bin/console aruba:login
 *   php bin/console aruba:login --username=me@example.com
 */
#[AsCommand(
    name: 'aruba:login',
    description: 'Login ad Aruba Business e salva il token in var/aruba_tokens.json',
)]
class ArubaLoginCommand extends Command
{
    private const TOKEN_FILE = __DIR__ . '/../../var/aruba_tokens.json';

    public function __construct(private readonly ArubaBusinessClient $client)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('username', 'u', InputOption::VALUE_OPTIONAL, 'Username Aruba Business')
            ->addOption('show-token', null, InputOption::VALUE_NONE, 'Mostra il token dopo il login');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Aruba Business — Login');
        $io->text('Questo comando ottiene un nuovo access token e lo salva in <info>var/aruba_tokens.json</info>.');
        $io->newLine();

        // Recupera l'username dall'opzione o chiede in interattivo (usa ENV come default se presente)
        $username = $input->getOption('username')
            ?? $io->ask('Username (es. user@arubabusiness.it)', $_ENV['ARUBA_USERNAME'] ?? null);

        $password = $io->askHidden('Password');

        if (!$username || !$password) {
            $io->error('Username e password sono obbligatori.');
            return Command::FAILURE;
        }

        $io->text('Connessione ad Aruba Business...');

        try {
            // Esegue l'autenticazione iniettando le credenziali nel client
            $this->client->authenticateWith($username, $password);

            $expiry = $this->client->getTokenExpiresAt();

            $io->success('Login effettuato con successo!');
            $io->definitionList(
                ['Token salvato in' => self::TOKEN_FILE],
                ['Scade il'         => date('d/m/Y H:i:s', $expiry)],
            );

            if ($input->getOption('show-token')) {
                $io->section('Access Token');
                $io->text($this->client->getAccessToken());
            }

            $io->note('Il token ha una validità di 24 ore. Il client MCP o gli script pianificati potranno rigenerarlo automaticamente usando le credenziali memorizzate in sicurezza.');

        } catch (\Throwable $e) {
            $io->error('Login fallito: ' . $e->getMessage());

            if ($output->isVerbose()) {
                $io->text($e->getTraceAsString());
            }

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}