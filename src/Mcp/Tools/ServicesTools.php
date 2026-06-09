<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class ServicesTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'services_services_getramstatisticsbydata',
                'Get RAM usage statistics for a domain in Cloud hosting',
                'GET',
                '/api/services/statistics/{DomainServiceId}/{ReferenceDate}/CloudHostingDomainRAMStats',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'DomainServiceId' => 
    array (
      'type' => 'integer',
      'description' => 'ServiceId of the domain for which to request RAM usage statistics',
    ),
     'ReferenceDate' => 
    array (
      'type' => 'string',
      'description' => 'Reference date in format yyyymmdd',
    ),
  ),
  'required' => 
  array (
    0 => 'DomainServiceId',
    1 => 'ReferenceDate',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_getramstatisticsbylastday',
                'Get RAM usage statistics for a domain in Cloud hosting in last days',
                'GET',
                '/api/services/statistics/{DomainServiceId}/CloudHostingDomainRAMStats/lastdays/{NumberOfDays}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'DomainServiceId' => 
    array (
      'type' => 'integer',
      'description' => 'ServiceId of the domain for which to request RAM usage statistics',
    ),
     'NumberOfDays' => 
    array (
      'type' => 'integer',
      'description' => '7 for last 7 days, 30 for last 30 days',
    ),
  ),
  'required' => 
  array (
    0 => 'DomainServiceId',
    1 => 'NumberOfDays',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_getcpustatisticsbydata',
                'Get CPU usage statistics for a domain in Cloud hosting',
                'GET',
                '/api/services/statistics/{DomainServiceId}/{ReferenceDate}/CloudHostingDomainCPUStats',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'DomainServiceId' => 
    array (
      'type' => 'integer',
      'description' => 'ServiceId of the domain for which to request CPU usage statistics',
    ),
     'ReferenceDate' => 
    array (
      'type' => 'string',
      'description' => 'Reference date in format yyyymmdd',
    ),
  ),
  'required' => 
  array (
    0 => 'DomainServiceId',
    1 => 'ReferenceDate',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_getcpustatisticsbylastday',
                'Get CPU usage statistics for a domain in Cloud hosting in last days',
                'GET',
                '/api/services/statistics/{DomainServiceId}/CloudHostingDomainCPUStats/lastdays/{NumberOfDays}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'DomainServiceId' => 
    array (
      'type' => 'integer',
      'description' => 'ServiceId of the domain for which to request RAM usage statistics',
    ),
     'NumberOfDays' => 
    array (
      'type' => 'integer',
      'description' => '7 for last 7 days, 30 for last 30 days',
    ),
  ),
  'required' => 
  array (
    0 => 'DomainServiceId',
    1 => 'NumberOfDays',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_getcloudhostingdomainresources',
                'Get resources for domains in a Cloud hosting plan',
                'GET',
                '/api/services/{cloudHostingServiceId}/cloudHostingDomainResources',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'cloudHostingServiceId' => 
    array (
      'type' => 'integer',
      'description' => 'Reference id of an existing Cloud hosting service',
    ),
  ),
  'required' => 
  array (
    0 => 'cloudHostingServiceId',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_updatecloudhostingdomainram',
                'update RAM quantity in MB for a domain in multi domain Cloud hosting',
                'PUT',
                '/api/services/cloudHostingDomainRAM',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'ramCloudHostingUpdate' => 
    array (
      'type' => 'integer',
      'description' => 'RAM quantity in MB for a domain',
    ),
  ),
  'required' => 
  array (
    0 => 'ramCloudHostingUpdate',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_downgradecloudhostingram',
                'Removes immediately a specified quantity of not allocated RAM in GB from a multidomain Cloud hosting plan',
                'PUT',
                '/api/services/DowngradeCloudHostingRAM',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'ramCloudHostingDowngrade' => 
    array (
      'type' => 'integer',
      'description' => 'RAM quantity in MB for a domain',
    ),
  ),
  'required' => 
  array (
    0 => 'ramCloudHostingDowngrade',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_updatecloudhostingdomainextracpu',
                'Update Extra CPU quantity for a domain in a Linux multi domain Cloud hosting',
                'PUT',
                '/api/services/CloudHostingDomainExtraCPU',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'cpuExtraCloudHostingUpdate' => 
    array (
      'type' => 'integer',
      'description' => 'Extra CPU quantity for a domain',
    ),
  ),
  'required' => 
  array (
    0 => 'cpuExtraCloudHostingUpdate',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_downgradecloudhostingextracpu',
                'Removes immediately a specified quantity of not allocated Extra CPU from a multidomain Linux Cloud hosting plan',
                'PUT',
                '/api/services/DowngradeCloudHostingExtraCPU',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'cpuExtraCloudHostingDowngrade' => 
    array (
      'type' => 'integer',
      'description' => 'Extra CPU quantity to be removed',
    ),
  ),
  'required' => 
  array (
    0 => 'cpuExtraCloudHostingDowngrade',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_gettechnicalpanelssolink',
                'Get the SSO link url to go to Plesk/cPanel',
                'GET',
                '/api/services/{domainName}/technicalPanelSSOLink',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domainName' => 
    array (
      'type' => 'string',
      'description' => 'Domain name',
    ),
  ),
  'required' => 
  array (
    0 => 'domainName',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_searchbyreference',
                'Get service detail searching by service reference',
                'GET',
                '/api/services',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'criteria.reference' => 
    array (
      'type' => 'string',
      'description' => 'Service reference',
    ),
     'criteria.isOnlyActive' => 
    array (
      'type' => 'boolean',
      'description' => 'Check is is only active',
    ),
     'criteria.isAlsoChildren' => 
    array (
      'type' => 'boolean',
      'description' => 'Check if is also children',
    ),
     'criteria.automaticRenew' => 
    array (
      'type' => 'boolean',
      'description' => 'Check if the automatic renewal is active',
    ),
     'criteria.endUserCode' => 
    array (
      'type' => 'string',
      'description' => 'Service enduser code',
    ),
     'criteria.expiredMonth' => 
    array (
      'type' => 'integer',
      'description' => 'Service validity expiration mnth',
    ),
     'criteria.expiredYear' => 
    array (
      'type' => 'integer',
      'description' => 'Service validity expiration year',
    ),
     'criteria.deep' => 
    array (
      'type' => 'boolean',
      'description' => 'Deep to get verbose output details',
    ),
  ),
  'required' => 
  array (
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_unsubscribeservice',
                'Unsubscribe Service by id service',
                'PUT',
                '/api/services/unsubscribe',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'unsubscribeOption' => 
    array (
      'type' => 'integer',
      'description' => 'Configuration to use for the unsubscribe action',
    ),
  ),
  'required' => 
  array (
    0 => 'unsubscribeOption',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_getserviceid',
                'Get service id from exact service reference',
                'GET',
                '/api/services/{Reference}/{ProductCode}/exact',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'Reference' => 
    array (
      'type' => 'string',
      'description' => 'Reference domain name',
    ),
     'ProductCode' => 
    array (
      'type' => 'string',
      'description' => 'Product code',
    ),
  ),
  'required' => 
  array (
    0 => 'Reference',
    1 => 'ProductCode',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_getservicedomainid',
                'Get service id from the name of an active domain',
                'GET',
                '/api/services/{DomainName}/serviceId',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'DomainName' => 
    array (
      'type' => 'string',
      'description' => 'Domain name',
    ),
  ),
  'required' => 
  array (
    0 => 'DomainName',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_getservice',
                'Get Service by IdService',
                'GET',
                '/api/services/{idService}/detail/{deep}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idService' => 
    array (
      'type' => 'integer',
      'description' => 'Service id',
    ),
     'deep' => 
    array (
      'type' => 'boolean',
      'description' => 'if true get output verbose description; false otherwise',
    ),
  ),
  'required' => 
  array (
    0 => 'idService',
    1 => 'deep',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_setautorenew',
                'Set service autorenew',
                'PUT',
                '/api/services/autorenew',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'autorenewRequest' => 
    array (
      'type' => 'boolean',
      'description' => 'Service detail',
    ),
  ),
  'required' => 
  array (
    0 => 'autorenewRequest',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_renewservices',
                'Generate renewal order',
                'POST',
                '/api/services/renewservices',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'renewService' => 
    array (
      'type' => 'integer',
      'description' => 'services renawal arguments',
    ),
  ),
  'required' => 
  array (
    0 => 'renewService',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_checkrenewableservice',
                'Check service\'s renewability',
                'GET',
                '/api/services/checkrenewableservice/{idService}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idService' => 
    array (
      'type' => 'integer',
      'description' => '',
    ),
  ),
  'required' => 
  array (
    0 => 'idService',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_deleteenduserforservice',
                'Delete username association for service',
                'DELETE',
                '/api/services/enduser',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idService' => 
    array (
      'type' => 'integer',
      'description' => 'Id service to disassociate username',
    ),
  ),
  'required' => 
  array (
    0 => 'idService',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'services_services_setenduserforservice',
                'Associate service with specific username enduser',
                'PUT',
                '/api/services/enduser',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'enduserServiceRequest' => 
    array (
      'type' => 'integer',
      'description' => 'Username and service to associate',
    ),
  ),
  'required' => 
  array (
    0 => 'enduserServiceRequest',
  ),
)
            ),
        ];
    }
}
