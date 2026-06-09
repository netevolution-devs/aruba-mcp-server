<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class DomainsTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'domains_domains_whoisdomain',
                'WhoIs on specific domain with extension',
                'GET',
                '/api/domains/{domain}/whois/{all}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain to scan',
    ),
     'all' => 
    array (
      'type' => 'boolean',
      'description' => 'if True or the domain has not extension the scan is executing also on this default list extensions:  "cloud", "it", "com", "org", "net", "biz", "eu", "info"',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
    1 => 'all',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_gettemplates',
                'Get custom dns templates',
                'GET',
                '/api/domains/dns/templates/{templateName}/detail',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'templateName' => 
    array (
      'type' => 'string',
      'description' => 'Get only templates having this word in its name',
    ),
  ),
  'required' => 
  array (
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_updatedomainttl',
                'Update zone ttl value',
                'PUT',
                '/api/domains/dns/ttl',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'integer',
      'description' => 'Set the zone and the ttl new value',
    ),
  ),
  'required' => 
  array (
    0 => 'model',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_getdomaininfo',
                'Get the domain details info',
                'GET',
                '/api/domains/dns/{zone}/details',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'zone' => 
    array (
      'type' => 'string',
      'description' => 'Domain name to get info',
    ),
  ),
  'required' => 
  array (
    0 => 'zone',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_getlogdomain',
                'Get the logs details for the zone',
                'GET',
                '/api/domains/dns/{zone}/log',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'zone' => 
    array (
      'type' => 'string',
      'description' => 'Domain name to get log info',
    ),
  ),
  'required' => 
  array (
    0 => 'zone',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_applytemplate',
                'Apply specific template to the zone',
                'PUT',
                '/api/domains/dns/{idZone}/applytemplate/{idTemplate}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idZone' => 
    array (
      'type' => 'integer',
      'description' => 'Dns zone iddentifier',
    ),
     'idTemplate' => 
    array (
      'type' => 'integer',
      'description' => 'Template id reference',
    ),
  ),
  'required' => 
  array (
    0 => 'idZone',
    1 => 'idTemplate',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_reset',
                'Reset zone',
                'PUT',
                '/api/domains/dns/{idZone}/applytemplate/default',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idZone' => 
    array (
      'type' => 'integer',
      'description' => 'dns zone identifier',
    ),
  ),
  'required' => 
  array (
    0 => 'idZone',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_deleterecord',
                'Delete specific record',
                'DELETE',
                '/api/domains/dns/record/{idRecord}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idRecord' => 
    array (
      'type' => 'integer',
      'description' => 'The record reference id',
    ),
  ),
  'required' => 
  array (
    0 => 'idRecord',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_addrecord',
                'Add new record to specific zone',
                'POST',
                '/api/domains/dns/record',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'integer',
      'description' => 'The new record details to add',
    ),
  ),
  'required' => 
  array (
    0 => 'model',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_updaterecord',
                'Update specific record',
                'PUT',
                '/api/domains/dns/record',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'integer',
      'description' => 'The new record details to update',
    ),
  ),
  'required' => 
  array (
    0 => 'model',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_getemailinfo',
                'Get details about email service on specific domain',
                'GET',
                '/api/domains/email/{domain}/details',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_getboxemaillist',
                'Get the email box list available on the domain',
                'GET',
                '/api/domains/email/{domain}/box',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_getaliasesdominio',
                'Get the alias list available on specific domain',
                'GET',
                '/api/domains/{domain}/alias/list',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_removealiasemail',
                'Delete specific alias email',
                'DELETE',
                '/api/domains/email/alias/{aliasEmail}/box',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'aliasEmail' => 
    array (
      'type' => 'string',
      'description' => 'Alias email to delete that also includes the domain name, ex: email@mydomain.it',
    ),
  ),
  'required' => 
  array (
    0 => 'aliasEmail',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_createaliasondominio',
                'Create new alias on specific domain',
                'POST',
                '/api/domains/{domain}/alias/{newAlias}/new',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain',
    ),
     'newAlias' => 
    array (
      'type' => 'string',
      'description' => 'New alias',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
    1 => 'newAlias',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_createaliasonmail',
                'Create new alias on specific emailbox',
                'POST',
                '/api/domains/email/{emailbox}/alias/{newAlias}/new',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'emailbox' => 
    array (
      'type' => 'string',
      'description' => 'Emailbox that also includes the domain name, ex: email@mydomain.it',
    ),
     'newAlias' => 
    array (
      'type' => 'string',
      'description' => 'New alias that also includes the domain name, ex: email_alias@mydomain.it',
    ),
  ),
  'required' => 
  array (
    0 => 'emailbox',
    1 => 'newAlias',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_createboxmailondominio',
                'Create new box email on specific domain',
                'POST',
                '/api/domains/email/{domain}/box/{email}/{password}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain',
    ),
     'email' => 
    array (
      'type' => 'string',
      'description' => 'Username email including @domain',
    ),
     'password' => 
    array (
      'type' => 'string',
      'description' => 'Password email',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
    1 => 'email',
    2 => 'password',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_createboxmailondominionew',
                'Create new box email on specific domain',
                'POST',
                '/api/domains/email/box',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'input' => 
    array (
      'type' => 'string',
      'description' => 'Detail email account',
    ),
  ),
  'required' => 
  array (
    0 => 'input',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_deleteboxmailondominio',
                'Delete box email on specific domain',
                'DELETE',
                '/api/domains/email/{domain}/{email}/box',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain',
    ),
     'email' => 
    array (
      'type' => 'string',
      'description' => 'Username email',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
    1 => 'email',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_setboxmailpasswordondominio',
                'Modify email password of specific account',
                'PATCH',
                '/api/domains/email/{domain}/box/{email}/password/{password}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain',
    ),
     'email' => 
    array (
      'type' => 'string',
      'description' => 'Username email',
    ),
     'password' => 
    array (
      'type' => 'string',
      'description' => 'New password email',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
    1 => 'email',
    2 => 'password',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_setboxmailpasswordondominionew',
                'Modify email password of specific account',
                'PATCH',
                '/api/domains/email/box/password',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'input' => 
    array (
      'type' => 'string',
      'description' => 'Detail new login email',
    ),
  ),
  'required' => 
  array (
    0 => 'input',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'domains_domains_getboxemailusedspacelist',
                'Get the email box used space list available on the domain',
                'GET',
                '/api/domains/email/{domain}/box/take/{take}/skip/{skip}/usedspace',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain',
    ),
     'take' => 
    array (
      'type' => 'integer',
      'description' => 'item domain to take',
    ),
     'skip' => 
    array (
      'type' => 'integer',
      'description' => 'item domain to skip',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
    1 => 'take',
    2 => 'skip',
  ),
)
            ),
        ];
    }
}
