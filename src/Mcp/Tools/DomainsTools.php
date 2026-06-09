<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class DomainsTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->domainsDomainsWhoIsDomainTool(),
            $this->domainsDomainsGetTemplatesTool(),
            $this->domainsDomainsUpdateDomainTtlTool(),
            $this->domainsDomainsGetDomainInfoTool(),
            $this->domainsDomainsGetLogDomainTool(),
            $this->domainsDomainsApplyTemplateTool(),
            $this->domainsDomainsResetTool(),
            $this->domainsDomainsDeleteRecordTool(),
            $this->domainsDomainsAddRecordTool(),
            $this->domainsDomainsUpdateRecordTool(),
            $this->domainsDomainsGetEmailInfoTool(),
            $this->domainsDomainsGetBoxEmailListTool(),
            $this->domainsDomainsGetAliasesDominioTool(),
            $this->domainsDomainsRemoveAliasEmailTool(),
            $this->domainsDomainsCreateAliasOnDominioTool(),
            $this->domainsDomainsCreateAliasOnMailTool(),
            $this->domainsDomainsCreateBoxMailOnDominioTool(),
            $this->domainsDomainsCreateBoxMailOnDominioNewTool(),
            $this->domainsDomainsDeleteBoxMailOnDominioTool(),
            $this->domainsDomainsSetBoxMailPasswordOnDominioTool(),
            $this->domainsDomainsSetBoxMailPasswordOnDominioNewTool(),
            $this->domainsDomainsGetBoxEmailUsedSpaceListTool(),
        ];
    }

    private function domainsDomainsWhoIsDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_whoisdomain'; }
            public function getDescription(): string { return 'WhoIs on specific domain with extension'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain to scan',
),
                        'all' => array (
  'type' => 'boolean',
  'description' => 'if True or the domain has not extension the scan is executing also on this default list extensions:  "cloud", "it", "com", "org", "net", "biz", "eu", "info"',
),
                    ],
                    'required' => array (
  0 => 'domain',
  1 => 'all',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/{domain}/whois/{all}';
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

    private function domainsDomainsGetTemplatesTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_gettemplates'; }
            public function getDescription(): string { return 'Get custom dns templates'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'templateName' => array (
  'type' => 'string',
  'description' => 'Get only templates having this word in its name',
),
                    ],
                    'required' => array (
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/dns/templates/{templateName}/detail';
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

    private function domainsDomainsUpdateDomainTtlTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_updatedomainttl'; }
            public function getDescription(): string { return 'Update zone ttl value'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'integer',
  'description' => 'Set the zone and the ttl new value',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/dns/ttl';
                $method = 'PUT';

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

    private function domainsDomainsGetDomainInfoTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_getdomaininfo'; }
            public function getDescription(): string { return 'Get the domain details info'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'zone' => array (
  'type' => 'string',
  'description' => 'Domain name to get info',
),
                    ],
                    'required' => array (
  0 => 'zone',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/dns/{zone}/details';
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

    private function domainsDomainsGetLogDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_getlogdomain'; }
            public function getDescription(): string { return 'Get the logs details for the zone'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'zone' => array (
  'type' => 'string',
  'description' => 'Domain name to get log info',
),
                    ],
                    'required' => array (
  0 => 'zone',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/dns/{zone}/log';
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

    private function domainsDomainsApplyTemplateTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_applytemplate'; }
            public function getDescription(): string { return 'Apply specific template to the zone'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idZone' => array (
  'type' => 'integer',
  'description' => 'Dns zone iddentifier',
),
                        'idTemplate' => array (
  'type' => 'integer',
  'description' => 'Template id reference',
),
                    ],
                    'required' => array (
  0 => 'idZone',
  1 => 'idTemplate',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/dns/{idZone}/applytemplate/{idTemplate}';
                $method = 'PUT';

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

    private function domainsDomainsResetTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_reset'; }
            public function getDescription(): string { return 'Reset zone'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idZone' => array (
  'type' => 'integer',
  'description' => 'dns zone identifier',
),
                    ],
                    'required' => array (
  0 => 'idZone',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/dns/{idZone}/applytemplate/default';
                $method = 'PUT';

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

    private function domainsDomainsDeleteRecordTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_deleterecord'; }
            public function getDescription(): string { return 'Delete specific record'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idRecord' => array (
  'type' => 'integer',
  'description' => 'The record reference id',
),
                    ],
                    'required' => array (
  0 => 'idRecord',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/dns/record/{idRecord}';
                $method = 'DELETE';

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

    private function domainsDomainsAddRecordTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_addrecord'; }
            public function getDescription(): string { return 'Add new record to specific zone'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'integer',
  'description' => 'The new record details to add',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/dns/record';
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

    private function domainsDomainsUpdateRecordTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_updaterecord'; }
            public function getDescription(): string { return 'Update specific record'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'model' => array (
  'type' => 'integer',
  'description' => 'The new record details to update',
),
                    ],
                    'required' => array (
  0 => 'model',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/dns/record';
                $method = 'PUT';

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

    private function domainsDomainsGetEmailInfoTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_getemailinfo'; }
            public function getDescription(): string { return 'Get details about email service on specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain',
),
                    ],
                    'required' => array (
  0 => 'domain',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/{domain}/details';
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

    private function domainsDomainsGetBoxEmailListTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_getboxemaillist'; }
            public function getDescription(): string { return 'Get the email box list available on the domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain',
),
                    ],
                    'required' => array (
  0 => 'domain',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/{domain}/box';
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

    private function domainsDomainsGetAliasesDominioTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_getaliasesdominio'; }
            public function getDescription(): string { return 'Get the alias list available on specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain',
),
                    ],
                    'required' => array (
  0 => 'domain',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/{domain}/alias/list';
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

    private function domainsDomainsRemoveAliasEmailTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_removealiasemail'; }
            public function getDescription(): string { return 'Delete specific alias email'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'aliasEmail' => array (
  'type' => 'string',
  'description' => 'Alias email to delete that also includes the domain name, ex: email@mydomain.it',
),
                    ],
                    'required' => array (
  0 => 'aliasEmail',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/alias/{aliasEmail}/box';
                $method = 'DELETE';

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

    private function domainsDomainsCreateAliasOnDominioTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_createaliasondominio'; }
            public function getDescription(): string { return 'Create new alias on specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain',
),
                        'newAlias' => array (
  'type' => 'string',
  'description' => 'New alias',
),
                    ],
                    'required' => array (
  0 => 'domain',
  1 => 'newAlias',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/{domain}/alias/{newAlias}/new';
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

    private function domainsDomainsCreateAliasOnMailTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_createaliasonmail'; }
            public function getDescription(): string { return 'Create new alias on specific emailbox'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'emailbox' => array (
  'type' => 'string',
  'description' => 'Emailbox that also includes the domain name, ex: email@mydomain.it',
),
                        'newAlias' => array (
  'type' => 'string',
  'description' => 'New alias that also includes the domain name, ex: email_alias@mydomain.it',
),
                    ],
                    'required' => array (
  0 => 'emailbox',
  1 => 'newAlias',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/{emailbox}/alias/{newAlias}/new';
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

    private function domainsDomainsCreateBoxMailOnDominioTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_createboxmailondominio'; }
            public function getDescription(): string { return 'Create new box email on specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain',
),
                        'email' => array (
  'type' => 'string',
  'description' => 'Username email including @domain',
),
                        'password' => array (
  'type' => 'string',
  'description' => 'Password email',
),
                    ],
                    'required' => array (
  0 => 'domain',
  1 => 'email',
  2 => 'password',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/{domain}/box/{email}/{password}';
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

    private function domainsDomainsCreateBoxMailOnDominioNewTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_createboxmailondominionew'; }
            public function getDescription(): string { return 'Create new box email on specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'input' => array (
  'type' => 'string',
  'description' => 'Detail email account',
),
                    ],
                    'required' => array (
  0 => 'input',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/box';
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

    private function domainsDomainsDeleteBoxMailOnDominioTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_deleteboxmailondominio'; }
            public function getDescription(): string { return 'Delete box email on specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain',
),
                        'email' => array (
  'type' => 'string',
  'description' => 'Username email',
),
                    ],
                    'required' => array (
  0 => 'domain',
  1 => 'email',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/{domain}/{email}/box';
                $method = 'DELETE';

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

    private function domainsDomainsSetBoxMailPasswordOnDominioTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_setboxmailpasswordondominio'; }
            public function getDescription(): string { return 'Modify email password of specific account'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain',
),
                        'email' => array (
  'type' => 'string',
  'description' => 'Username email',
),
                        'password' => array (
  'type' => 'string',
  'description' => 'New password email',
),
                    ],
                    'required' => array (
  0 => 'domain',
  1 => 'email',
  2 => 'password',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/{domain}/box/{email}/password/{password}';
                $method = 'PATCH';

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

    private function domainsDomainsSetBoxMailPasswordOnDominioNewTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_setboxmailpasswordondominionew'; }
            public function getDescription(): string { return 'Modify email password of specific account'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'input' => array (
  'type' => 'string',
  'description' => 'Detail new login email',
),
                    ],
                    'required' => array (
  0 => 'input',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/box/password';
                $method = 'PATCH';

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

    private function domainsDomainsGetBoxEmailUsedSpaceListTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'domains_domains_getboxemailusedspacelist'; }
            public function getDescription(): string { return 'Get the email box used space list available on the domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain',
),
                        'take' => array (
  'type' => 'integer',
  'description' => 'item domain to take',
),
                        'skip' => array (
  'type' => 'integer',
  'description' => 'item domain to skip',
),
                    ],
                    'required' => array (
  0 => 'domain',
  1 => 'take',
  2 => 'skip',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/domains/email/{domain}/box/take/{take}/skip/{skip}/usedspace';
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
