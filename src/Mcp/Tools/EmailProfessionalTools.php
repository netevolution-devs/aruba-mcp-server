<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class EmailProfessionalTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->managedMailProfessionalManagedMailProfessionalCreateDomainTool(),
            $this->managedMailProfessionalManagedMailProfessionalDeleteDomainTool(),
            $this->managedMailProfessionalManagedMailProfessionalGetDomainDetailTool(),
            $this->managedMailProfessionalManagedMailProfessionalDomainDefaultQuotaModifyTool(),
            $this->managedMailProfessionalManagedMailProfessionalDomainNumberBoxesModifyTool(),
            $this->managedMailProfessionalManagedMailProfessionalSearchTool(),
            $this->managedMailProfessionalManagedMailProfessionalCreateBoxMailTool(),
            $this->managedMailProfessionalManagedMailProfessionalDeleteBoxMailTool(),
            $this->managedMailProfessionalManagedMailProfessionalMailBoxQuotaModifyTool(),
            $this->managedMailProfessionalManagedMailProfessionalChangeMailPasswordTool(),
            $this->managedMailProfessionalManagedMailProfessionalGetListaEmailAliasTool(),
            $this->managedMailProfessionalManagedMailProfessionalGetDomainAliasesTool(),
            $this->managedMailProfessionalManagedMailProfessionalGetContractResourceTool(),
            $this->managedMailProfessionalManagedMailProfessionalSuspendDomainTool(),
            $this->managedMailProfessionalManagedMailProfessionalReactivateDomainTool(),
            $this->managedMailProfessionalManagedMailProfessionalSuspendMailBoxTool(),
            $this->managedMailProfessionalManagedMailProfessionalReactivateMailBoxTool(),
            $this->managedMailProfessionalManagedMailProfessionalRemoveAliasEmailTool(),
            $this->managedMailProfessionalManagedMailProfessionalRemoveAliasDomainTool(),
            $this->managedMailProfessionalManagedMailProfessionalCreateAliasOnDominioTool(),
            $this->managedMailProfessionalManagedMailProfessionalCreateAliasOnMailTool(),
            $this->managedMailProfessionalManagedMailProfessionalGetDomainListMailBoxesUsedSpaceTool(),
            $this->managedMailProfessionalManagedMailProfessionalGetSearchEmailsDomainTool(),
            $this->managedMailProfessionalManagedMailProfessionalPasswordManagementTool(),
            $this->managedMailProfessionalManagedMailProfessionalPasswordExpirationActionTool(),
        ];
    }

    private function managedMailProfessionalManagedMailProfessionalCreateDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_createdomain'; }
            public function getDescription(): string { return 'Create new domain on specific contract'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        '_request' => array (
  'type' => 'integer',
  'description' => 'New domain detail',
),
                    ],
                    'required' => array (
  0 => '_request',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/domain';
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

    private function managedMailProfessionalManagedMailProfessionalDeleteDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_deletedomain'; }
            public function getDescription(): string { return 'Delete specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'reference' => array (
  'type' => 'string',
  'description' => 'Contract name that contains domain',
),
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain name to delete',
),
                    ],
                    'required' => array (
  0 => 'reference',
  1 => 'domain',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/{reference}/contract/{domain}/domain';
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

    private function managedMailProfessionalManagedMailProfessionalGetDomainDetailTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_getdomaindetail'; }
            public function getDescription(): string { return 'Get domain detail'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain name',
),
                        'reference' => array (
  'type' => 'string',
  'description' => 'Contract name reference',
),
                    ],
                    'required' => array (
  0 => 'domain',
  1 => 'reference',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/{reference}/contract/{domain}/domain';
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

    private function managedMailProfessionalManagedMailProfessionalDomainDefaultQuotaModifyTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_domaindefaultquotamodify'; }
            public function getDescription(): string { return 'Update domain default quota'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'modifyDomainQuota' => array (
  'type' => 'integer',
  'description' => 'Request detail',
),
                    ],
                    'required' => array (
  0 => 'modifyDomainQuota',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/domain/quota';
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

    private function managedMailProfessionalManagedMailProfessionalDomainNumberBoxesModifyTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_domainnumberboxesmodify'; }
            public function getDescription(): string { return 'Update domain number boxes'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'modifyNumberBoxes' => array (
  'type' => 'integer',
  'description' => 'Request detail',
),
                    ],
                    'required' => array (
  0 => 'modifyNumberBoxes',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/domain/numberofboxes';
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

    private function managedMailProfessionalManagedMailProfessionalSearchTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_search'; }
            public function getDescription(): string { return 'Search domain related to specific contract'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'search.reference' => array (
  'type' => 'string',
  'description' => '',
),
                        'search.skip' => array (
  'type' => 'integer',
  'description' => '',
),
                        'search.take' => array (
  'type' => 'integer',
  'description' => '',
),
                        'search.filterDomain' => array (
  'type' => 'string',
  'description' => '',
),
                    ],
                    'required' => array (
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/domains/search';
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

    private function managedMailProfessionalManagedMailProfessionalCreateBoxMailTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_createboxmail'; }
            public function getDescription(): string { return 'Create new box email on specific domain and contract'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'request' => array (
  'type' => 'string',
  'description' => 'email details to create',
),
                    ],
                    'required' => array (
  0 => 'request',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/domain/email';
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

    private function managedMailProfessionalManagedMailProfessionalDeleteBoxMailTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_deleteboxmail'; }
            public function getDescription(): string { return 'Delete box email belong to specific domain and contract'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'reference' => array (
  'type' => 'string',
  'description' => 'Reference name contract',
),
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain name',
),
                        'email' => array (
  'type' => 'string',
  'description' => 'Email name to delete',
),
                    ],
                    'required' => array (
  0 => 'reference',
  1 => 'domain',
  2 => 'email',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/{reference}/contract/{domain}/domain/{email}/email';
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

    private function managedMailProfessionalManagedMailProfessionalMailBoxQuotaModifyTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_mailboxquotamodify'; }
            public function getDescription(): string { return 'Update email quota'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'mailUpdateRequest' => array (
  'type' => 'integer',
  'description' => 'Request detail',
),
                    ],
                    'required' => array (
  0 => 'mailUpdateRequest',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/mail/quota';
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

    private function managedMailProfessionalManagedMailProfessionalChangeMailPasswordTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_changemailpassword'; }
            public function getDescription(): string { return 'Change mail password'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'sharedMailChangePassword' => array (
  'type' => 'string',
  'description' => 'Request detail',
),
                    ],
                    'required' => array (
  0 => 'sharedMailChangePassword',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/mail/password';
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

    private function managedMailProfessionalManagedMailProfessionalGetListaEmailAliasTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_getlistaemailalias'; }
            public function getDescription(): string { return 'Get email alias on specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain to get alias email',
),
                        'reference' => array (
  'type' => 'string',
  'description' => 'Contract reference',
),
                        'skip' => array (
  'type' => 'integer',
  'description' => 'In case of element to skip',
),
                        'take' => array (
  'type' => 'integer',
  'description' => 'In case of limit element to take',
),
                    ],
                    'required' => array (
  0 => 'domain',
  1 => 'reference',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/alias/{reference}/contract/{domain}/domain/search/take/{take}/skip/{skip}/email';
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

    private function managedMailProfessionalManagedMailProfessionalGetDomainAliasesTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_getdomainaliases'; }
            public function getDescription(): string { return 'Get domain alias'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domain' => array (
  'type' => 'string',
  'description' => 'Domain to get alias',
),
                        'reference' => array (
  'type' => 'string',
  'description' => 'Contract reference',
),
                    ],
                    'required' => array (
  0 => 'domain',
  1 => 'reference',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/alias/{reference}/contract/{domain}/domain/search/domain';
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

    private function managedMailProfessionalManagedMailProfessionalGetContractResourceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_getcontractresource'; }
            public function getDescription(): string { return 'Get contract resource'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'reference' => array (
  'type' => 'string',
  'description' => 'Contract name reference',
),
                    ],
                    'required' => array (
  0 => 'reference',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/{reference}/contract/resources';
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

    private function managedMailProfessionalManagedMailProfessionalSuspendDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_suspenddomain'; }
            public function getDescription(): string { return 'Suspends a domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'sMailBoxReferenceDomainRequest' => array (
  'type' => 'string',
  'description' => 'Domain and contract reference details',
),
                    ],
                    'required' => array (
  0 => 'sMailBoxReferenceDomainRequest',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/domain/suspend';
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

    private function managedMailProfessionalManagedMailProfessionalReactivateDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_reactivatedomain'; }
            public function getDescription(): string { return 'Reactivates a domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'sMailBoxReferenceDomainRequest' => array (
  'type' => 'string',
  'description' => 'Domain and contract reference details',
),
                    ],
                    'required' => array (
  0 => 'sMailBoxReferenceDomainRequest',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/domain/reactivate';
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

    private function managedMailProfessionalManagedMailProfessionalSuspendMailBoxTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_suspendmailbox'; }
            public function getDescription(): string { return 'Suspends a mail box'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'mailToSuspendMailBoxRequest' => array (
  'type' => 'string',
  'description' => 'Details box mail to suspend',
),
                    ],
                    'required' => array (
  0 => 'mailToSuspendMailBoxRequest',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/mail/suspend';
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

    private function managedMailProfessionalManagedMailProfessionalReactivateMailBoxTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_reactivatemailbox'; }
            public function getDescription(): string { return 'Reactivates a mail box'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'mailReactivateMailBoxRequest' => array (
  'type' => 'string',
  'description' => 'Details box mail to reactivate',
),
                    ],
                    'required' => array (
  0 => 'mailReactivateMailBoxRequest',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/mail/reactivate';
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

    private function managedMailProfessionalManagedMailProfessionalRemoveAliasEmailTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_removealiasemail'; }
            public function getDescription(): string { return 'Delete specific alias email'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'reference' => array (
  'type' => 'string',
  'description' => 'Contract name reference',
),
                        'domainAlias' => array (
  'type' => 'string',
  'description' => 'Fraction alias domain mail',
),
                        'aliasEmail' => array (
  'type' => 'string',
  'description' => 'Franction alias account email',
),
                    ],
                    'required' => array (
  0 => 'reference',
  1 => 'domainAlias',
  2 => 'aliasEmail',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/{reference}/contract/alias/{domainAlias}/{aliasEmail}/box';
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

    private function managedMailProfessionalManagedMailProfessionalRemoveAliasDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_removealiasdomain'; }
            public function getDescription(): string { return 'Remove specific alias domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'reference' => array (
  'type' => 'string',
  'description' => 'Contract name reference',
),
                        'domain' => array (
  'type' => 'string',
  'description' => 'domain name',
),
                        'aliasDomain' => array (
  'type' => 'string',
  'description' => 'alias name to remove',
),
                    ],
                    'required' => array (
  0 => 'reference',
  1 => 'domain',
  2 => 'aliasDomain',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/{reference}/contract/{domain}/domain/alias/{aliasDomain}/domain';
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

    private function managedMailProfessionalManagedMailProfessionalCreateAliasOnDominioTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_createaliasondominio'; }
            public function getDescription(): string { return 'Create new alias on specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'newAliasDomainRequest' => array (
  'type' => 'string',
  'description' => 'Alias domain detail to update',
),
                    ],
                    'required' => array (
  0 => 'newAliasDomainRequest',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/domain/alias/new';
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

    private function managedMailProfessionalManagedMailProfessionalCreateAliasOnMailTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_createaliasonmail'; }
            public function getDescription(): string { return 'Create new alias on specific emailbox'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'sMailBoxNewAliasRequest' => array (
  'type' => 'string',
  'description' => 'Email alias detail to update',
),
                    ],
                    'required' => array (
  0 => 'sMailBoxNewAliasRequest',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/email/alias/new';
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

    private function managedMailProfessionalManagedMailProfessionalGetDomainListMailBoxesUsedSpaceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_getdomainlistmailboxesusedspace'; }
            public function getDescription(): string { return 'Get MailBoxes Used Space'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'reference' => array (
  'type' => 'string',
  'description' => 'Contract reference',
),
                        'domain' => array (
  'type' => 'string',
  'description' => '',
),
                        'orderByField' => array (
  'type' => 'string',
  'description' => '',
),
                        'take' => array (
  'type' => 'integer',
  'description' => '',
),
                        'skip' => array (
  'type' => 'integer',
  'description' => '',
),
                        'filterEmail' => array (
  'type' => 'string',
  'description' => '',
),
                    ],
                    'required' => array (
  0 => 'reference',
  1 => 'domain',
  2 => 'orderByField',
  3 => 'take',
  4 => 'skip',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/{reference}/contract/{domain}/domain/orderbyfield/{orderByField}/take/{take}/skip/{skip}/usedspace';
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

    private function managedMailProfessionalManagedMailProfessionalGetSearchEmailsDomainTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_getsearchemailsdomain'; }
            public function getDescription(): string { return 'Get email list on specific domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'search.reference' => array (
  'type' => 'string',
  'description' => '',
),
                        'search.domain' => array (
  'type' => 'string',
  'description' => '',
),
                        'search.skip' => array (
  'type' => 'integer',
  'description' => '',
),
                        'search.take' => array (
  'type' => 'integer',
  'description' => '',
),
                        'search.filterEmail' => array (
  'type' => 'string',
  'description' => '',
),
                    ],
                    'required' => array (
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/domain/emails';
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

    private function managedMailProfessionalManagedMailProfessionalPasswordManagementTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_passwordmanagement'; }
            public function getDescription(): string { return 'Password management'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'passwordManagementInput' => array (
  'type' => 'boolean',
  'description' => 'Details password management',
),
                    ],
                    'required' => array (
  0 => 'passwordManagementInput',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/mail/PasswordManagement';
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

    private function managedMailProfessionalManagedMailProfessionalPasswordExpirationActionTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'managedmailprofessional_managedmailprofessional_passwordexpirationaction'; }
            public function getDescription(): string { return 'Password expiration'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'passwordExpirationInput' => array (
  'type' => 'boolean',
  'description' => 'Details password management',
),
                    ],
                    'required' => array (
  0 => 'passwordExpirationInput',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/managedmailprofessional/contract/mail/PasswordExpiration';
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
}
