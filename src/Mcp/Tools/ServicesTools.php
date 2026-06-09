<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class ServicesTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            $this->servicesServicesGetRAMStatisticsByDataTool(),
            $this->servicesServicesGetRAMStatisticsByLastDayTool(),
            $this->servicesServicesGetCPUStatisticsByDataTool(),
            $this->servicesServicesGetCPUStatisticsByLastDayTool(),
            $this->servicesServicesGetCloudHostingDomainResourcesTool(),
            $this->servicesServicesUpdateCloudHostingDomainRAMTool(),
            $this->servicesServicesDowngradeCloudHostingRAMTool(),
            $this->servicesServicesUpdateCloudHostingDomainExtraCPUTool(),
            $this->servicesServicesDowngradeCloudHostingExtraCPUTool(),
            $this->servicesServicesGetTechnicalPanelSSOLinkTool(),
            $this->servicesServicesSearchByReferenceTool(),
            $this->servicesServicesUnsubscribeServiceTool(),
            $this->servicesServicesGetServiceIdTool(),
            $this->servicesServicesGetServiceDomainIdTool(),
            $this->servicesServicesGetServiceTool(),
            $this->servicesServicesSetAutorenewTool(),
            $this->servicesServicesRenewServicesTool(),
            $this->servicesServicesCheckRenewableServiceTool(),
            $this->servicesServicesDeleteEndUserForServiceTool(),
            $this->servicesServicesSetEndUserForServiceTool(),
        ];
    }

    private function servicesServicesGetRAMStatisticsByDataTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_getramstatisticsbydata'; }
            public function getDescription(): string { return 'Get RAM usage statistics for a domain in Cloud hosting'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'DomainServiceId' => array (
  'type' => 'integer',
  'description' => 'ServiceId of the domain for which to request RAM usage statistics',
),
                        'ReferenceDate' => array (
  'type' => 'string',
  'description' => 'Reference date in format yyyymmdd',
),
                    ],
                    'required' => array (
  0 => 'DomainServiceId',
  1 => 'ReferenceDate',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/statistics/{DomainServiceId}/{ReferenceDate}/CloudHostingDomainRAMStats';
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

    private function servicesServicesGetRAMStatisticsByLastDayTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_getramstatisticsbylastday'; }
            public function getDescription(): string { return 'Get RAM usage statistics for a domain in Cloud hosting in last days'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'DomainServiceId' => array (
  'type' => 'integer',
  'description' => 'ServiceId of the domain for which to request RAM usage statistics',
),
                        'NumberOfDays' => array (
  'type' => 'integer',
  'description' => '7 for last 7 days, 30 for last 30 days',
),
                    ],
                    'required' => array (
  0 => 'DomainServiceId',
  1 => 'NumberOfDays',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/statistics/{DomainServiceId}/CloudHostingDomainRAMStats/lastdays/{NumberOfDays}';
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

    private function servicesServicesGetCPUStatisticsByDataTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_getcpustatisticsbydata'; }
            public function getDescription(): string { return 'Get CPU usage statistics for a domain in Cloud hosting'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'DomainServiceId' => array (
  'type' => 'integer',
  'description' => 'ServiceId of the domain for which to request CPU usage statistics',
),
                        'ReferenceDate' => array (
  'type' => 'string',
  'description' => 'Reference date in format yyyymmdd',
),
                    ],
                    'required' => array (
  0 => 'DomainServiceId',
  1 => 'ReferenceDate',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/statistics/{DomainServiceId}/{ReferenceDate}/CloudHostingDomainCPUStats';
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

    private function servicesServicesGetCPUStatisticsByLastDayTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_getcpustatisticsbylastday'; }
            public function getDescription(): string { return 'Get CPU usage statistics for a domain in Cloud hosting in last days'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'DomainServiceId' => array (
  'type' => 'integer',
  'description' => 'ServiceId of the domain for which to request RAM usage statistics',
),
                        'NumberOfDays' => array (
  'type' => 'integer',
  'description' => '7 for last 7 days, 30 for last 30 days',
),
                    ],
                    'required' => array (
  0 => 'DomainServiceId',
  1 => 'NumberOfDays',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/statistics/{DomainServiceId}/CloudHostingDomainCPUStats/lastdays/{NumberOfDays}';
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

    private function servicesServicesGetCloudHostingDomainResourcesTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_getcloudhostingdomainresources'; }
            public function getDescription(): string { return 'Get resources for domains in a Cloud hosting plan'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'cloudHostingServiceId' => array (
  'type' => 'integer',
  'description' => 'Reference id of an existing Cloud hosting service',
),
                    ],
                    'required' => array (
  0 => 'cloudHostingServiceId',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/{cloudHostingServiceId}/cloudHostingDomainResources';
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

    private function servicesServicesUpdateCloudHostingDomainRAMTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_updatecloudhostingdomainram'; }
            public function getDescription(): string { return 'update RAM quantity in MB for a domain in multi domain Cloud hosting'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'ramCloudHostingUpdate' => array (
  'type' => 'integer',
  'description' => 'RAM quantity in MB for a domain',
),
                    ],
                    'required' => array (
  0 => 'ramCloudHostingUpdate',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/cloudHostingDomainRAM';
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

    private function servicesServicesDowngradeCloudHostingRAMTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_downgradecloudhostingram'; }
            public function getDescription(): string { return 'Removes immediately a specified quantity of not allocated RAM in GB from a multidomain Cloud hosting plan'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'ramCloudHostingDowngrade' => array (
  'type' => 'integer',
  'description' => 'RAM quantity in MB for a domain',
),
                    ],
                    'required' => array (
  0 => 'ramCloudHostingDowngrade',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/DowngradeCloudHostingRAM';
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

    private function servicesServicesUpdateCloudHostingDomainExtraCPUTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_updatecloudhostingdomainextracpu'; }
            public function getDescription(): string { return 'Update Extra CPU quantity for a domain in a Linux multi domain Cloud hosting'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'cpuExtraCloudHostingUpdate' => array (
  'type' => 'integer',
  'description' => 'Extra CPU quantity for a domain',
),
                    ],
                    'required' => array (
  0 => 'cpuExtraCloudHostingUpdate',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/CloudHostingDomainExtraCPU';
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

    private function servicesServicesDowngradeCloudHostingExtraCPUTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_downgradecloudhostingextracpu'; }
            public function getDescription(): string { return 'Removes immediately a specified quantity of not allocated Extra CPU from a multidomain Linux Cloud hosting plan'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'cpuExtraCloudHostingDowngrade' => array (
  'type' => 'integer',
  'description' => 'Extra CPU quantity to be removed',
),
                    ],
                    'required' => array (
  0 => 'cpuExtraCloudHostingDowngrade',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/DowngradeCloudHostingExtraCPU';
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

    private function servicesServicesGetTechnicalPanelSSOLinkTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_gettechnicalpanelssolink'; }
            public function getDescription(): string { return 'Get the SSO link url to go to Plesk/cPanel'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'domainName' => array (
  'type' => 'string',
  'description' => 'Domain name',
),
                    ],
                    'required' => array (
  0 => 'domainName',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/{domainName}/technicalPanelSSOLink';
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

    private function servicesServicesSearchByReferenceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_searchbyreference'; }
            public function getDescription(): string { return 'Get service detail searching by service reference'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'criteria.reference' => array (
  'type' => 'string',
  'description' => 'Service reference',
),
                        'criteria.isOnlyActive' => array (
  'type' => 'boolean',
  'description' => 'Check is is only active',
),
                        'criteria.isAlsoChildren' => array (
  'type' => 'boolean',
  'description' => 'Check if is also children',
),
                        'criteria.automaticRenew' => array (
  'type' => 'boolean',
  'description' => 'Check if the automatic renewal is active',
),
                        'criteria.endUserCode' => array (
  'type' => 'string',
  'description' => 'Service enduser code',
),
                        'criteria.expiredMonth' => array (
  'type' => 'integer',
  'description' => 'Service validity expiration mnth',
),
                        'criteria.expiredYear' => array (
  'type' => 'integer',
  'description' => 'Service validity expiration year',
),
                        'criteria.deep' => array (
  'type' => 'boolean',
  'description' => 'Deep to get verbose output details',
),
                    ],
                    'required' => array (
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services';
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

    private function servicesServicesUnsubscribeServiceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_unsubscribeservice'; }
            public function getDescription(): string { return 'Unsubscribe Service by id service'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'unsubscribeOption' => array (
  'type' => 'integer',
  'description' => 'Configuration to use for the unsubscribe action',
),
                    ],
                    'required' => array (
  0 => 'unsubscribeOption',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/unsubscribe';
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

    private function servicesServicesGetServiceIdTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_getserviceid'; }
            public function getDescription(): string { return 'Get service id from exact service reference'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'Reference' => array (
  'type' => 'string',
  'description' => 'Reference domain name',
),
                        'ProductCode' => array (
  'type' => 'string',
  'description' => 'Product code',
),
                    ],
                    'required' => array (
  0 => 'Reference',
  1 => 'ProductCode',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/{Reference}/{ProductCode}/exact';
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

    private function servicesServicesGetServiceDomainIdTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_getservicedomainid'; }
            public function getDescription(): string { return 'Get service id from the name of an active domain'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'DomainName' => array (
  'type' => 'string',
  'description' => 'Domain name',
),
                    ],
                    'required' => array (
  0 => 'DomainName',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/{DomainName}/serviceId';
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

    private function servicesServicesGetServiceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_getservice'; }
            public function getDescription(): string { return 'Get Service by IdService'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idService' => array (
  'type' => 'integer',
  'description' => 'Service id',
),
                        'deep' => array (
  'type' => 'boolean',
  'description' => 'if true get output verbose description; false otherwise',
),
                    ],
                    'required' => array (
  0 => 'idService',
  1 => 'deep',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/{idService}/detail/{deep}';
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

    private function servicesServicesSetAutorenewTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_setautorenew'; }
            public function getDescription(): string { return 'Set service autorenew'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'autorenewRequest' => array (
  'type' => 'boolean',
  'description' => 'Service detail',
),
                    ],
                    'required' => array (
  0 => 'autorenewRequest',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/autorenew';
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

    private function servicesServicesRenewServicesTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_renewservices'; }
            public function getDescription(): string { return 'Generate renewal order'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'renewService' => array (
  'type' => 'integer',
  'description' => 'services renawal arguments',
),
                    ],
                    'required' => array (
  0 => 'renewService',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/renewservices';
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

    private function servicesServicesCheckRenewableServiceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_checkrenewableservice'; }
            public function getDescription(): string { return 'Check service\'s renewability'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idService' => array (
  'type' => 'integer',
  'description' => '',
),
                    ],
                    'required' => array (
  0 => 'idService',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/checkrenewableservice/{idService}';
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

    private function servicesServicesDeleteEndUserForServiceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_deleteenduserforservice'; }
            public function getDescription(): string { return 'Delete username association for service'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'idService' => array (
  'type' => 'integer',
  'description' => 'Id service to disassociate username',
),
                    ],
                    'required' => array (
  0 => 'idService',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/enduser';
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

    private function servicesServicesSetEndUserForServiceTool(): McpToolInterface
    {
        return new class($this->client) implements McpToolInterface {
            public function __construct(private ArubaBusinessClient $client) {}

            public function getName(): string { return 'services_services_setenduserforservice'; }
            public function getDescription(): string { return 'Associate service with specific username enduser'; }

            public function getInputSchema(): array {
                return [
                    'type' => 'object',
                    'properties' => [
                        'enduserServiceRequest' => array (
  'type' => 'integer',
  'description' => 'Username and service to associate',
),
                    ],
                    'required' => array (
  0 => 'enduserServiceRequest',
),
                ];
            }

            public function execute(array $params): array {
                $path = '/api/services/enduser';
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
