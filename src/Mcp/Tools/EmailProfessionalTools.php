<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class EmailProfessionalTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_createdomain',
                'Create new domain on specific contract',
                'POST',
                '/api/managedmailprofessional/contract/domain',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     '_request' => 
    array (
      'type' => 'integer',
      'description' => 'New domain detail',
    ),
  ),
  'required' => 
  array (
    0 => '_request',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_deletedomain',
                'Delete specific domain',
                'DELETE',
                '/api/managedmailprofessional/{reference}/contract/{domain}/domain',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'reference' => 
    array (
      'type' => 'string',
      'description' => 'Contract name that contains domain',
    ),
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain name to delete',
    ),
  ),
  'required' => 
  array (
    0 => 'reference',
    1 => 'domain',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_getdomaindetail',
                'Get domain detail',
                'GET',
                '/api/managedmailprofessional/{reference}/contract/{domain}/domain',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain name',
    ),
     'reference' => 
    array (
      'type' => 'string',
      'description' => 'Contract name reference',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
    1 => 'reference',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_domaindefaultquotamodify',
                'Update domain default quota',
                'PUT',
                '/api/managedmailprofessional/contract/domain/quota',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'modifyDomainQuota' => 
    array (
      'type' => 'integer',
      'description' => 'Request detail',
    ),
  ),
  'required' => 
  array (
    0 => 'modifyDomainQuota',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_domainnumberboxesmodify',
                'Update domain number boxes',
                'PUT',
                '/api/managedmailprofessional/contract/domain/numberofboxes',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'modifyNumberBoxes' => 
    array (
      'type' => 'integer',
      'description' => 'Request detail',
    ),
  ),
  'required' => 
  array (
    0 => 'modifyNumberBoxes',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_search',
                'Search domain related to specific contract',
                'GET',
                '/api/managedmailprofessional/domains/search',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'search.reference' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
     'search.skip' => 
    array (
      'type' => 'integer',
      'description' => '',
    ),
     'search.take' => 
    array (
      'type' => 'integer',
      'description' => '',
    ),
     'search.filterDomain' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
  ),
  'required' => 
  array (
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_createboxmail',
                'Create new box email on specific domain and contract',
                'POST',
                '/api/managedmailprofessional/contract/domain/email',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'request' => 
    array (
      'type' => 'string',
      'description' => 'email details to create',
    ),
  ),
  'required' => 
  array (
    0 => 'request',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_deleteboxmail',
                'Delete box email belong to specific domain and contract',
                'DELETE',
                '/api/managedmailprofessional/{reference}/contract/{domain}/domain/{email}/email',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'reference' => 
    array (
      'type' => 'string',
      'description' => 'Reference name contract',
    ),
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain name',
    ),
     'email' => 
    array (
      'type' => 'string',
      'description' => 'Email name to delete',
    ),
  ),
  'required' => 
  array (
    0 => 'reference',
    1 => 'domain',
    2 => 'email',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_mailboxquotamodify',
                'Update email quota',
                'PUT',
                '/api/managedmailprofessional/contract/mail/quota',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'mailUpdateRequest' => 
    array (
      'type' => 'integer',
      'description' => 'Request detail',
    ),
  ),
  'required' => 
  array (
    0 => 'mailUpdateRequest',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_changemailpassword',
                'Change mail password',
                'PATCH',
                '/api/managedmailprofessional/contract/mail/password',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'sharedMailChangePassword' => 
    array (
      'type' => 'string',
      'description' => 'Request detail',
    ),
  ),
  'required' => 
  array (
    0 => 'sharedMailChangePassword',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_getlistaemailalias',
                'Get email alias on specific domain',
                'GET',
                '/api/managedmailprofessional/alias/{reference}/contract/{domain}/domain/search/take/{take}/skip/{skip}/email',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain to get alias email',
    ),
     'reference' => 
    array (
      'type' => 'string',
      'description' => 'Contract reference',
    ),
     'skip' => 
    array (
      'type' => 'integer',
      'description' => 'In case of element to skip',
    ),
     'take' => 
    array (
      'type' => 'integer',
      'description' => 'In case of limit element to take',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
    1 => 'reference',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_getdomainaliases',
                'Get domain alias',
                'GET',
                '/api/managedmailprofessional/alias/{reference}/contract/{domain}/domain/search/domain',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'Domain to get alias',
    ),
     'reference' => 
    array (
      'type' => 'string',
      'description' => 'Contract reference',
    ),
  ),
  'required' => 
  array (
    0 => 'domain',
    1 => 'reference',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_getcontractresource',
                'Get contract resource',
                'GET',
                '/api/managedmailprofessional/{reference}/contract/resources',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'reference' => 
    array (
      'type' => 'string',
      'description' => 'Contract name reference',
    ),
  ),
  'required' => 
  array (
    0 => 'reference',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_suspenddomain',
                'Suspends a domain',
                'PUT',
                '/api/managedmailprofessional/contract/domain/suspend',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'sMailBoxReferenceDomainRequest' => 
    array (
      'type' => 'string',
      'description' => 'Domain and contract reference details',
    ),
  ),
  'required' => 
  array (
    0 => 'sMailBoxReferenceDomainRequest',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_reactivatedomain',
                'Reactivates a domain',
                'PUT',
                '/api/managedmailprofessional/contract/domain/reactivate',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'sMailBoxReferenceDomainRequest' => 
    array (
      'type' => 'string',
      'description' => 'Domain and contract reference details',
    ),
  ),
  'required' => 
  array (
    0 => 'sMailBoxReferenceDomainRequest',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_suspendmailbox',
                'Suspends a mail box',
                'PUT',
                '/api/managedmailprofessional/contract/mail/suspend',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'mailToSuspendMailBoxRequest' => 
    array (
      'type' => 'string',
      'description' => 'Details box mail to suspend',
    ),
  ),
  'required' => 
  array (
    0 => 'mailToSuspendMailBoxRequest',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_reactivatemailbox',
                'Reactivates a mail box',
                'PUT',
                '/api/managedmailprofessional/contract/mail/reactivate',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'mailReactivateMailBoxRequest' => 
    array (
      'type' => 'string',
      'description' => 'Details box mail to reactivate',
    ),
  ),
  'required' => 
  array (
    0 => 'mailReactivateMailBoxRequest',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_removealiasemail',
                'Delete specific alias email',
                'DELETE',
                '/api/managedmailprofessional/{reference}/contract/alias/{domainAlias}/{aliasEmail}/box',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'reference' => 
    array (
      'type' => 'string',
      'description' => 'Contract name reference',
    ),
     'domainAlias' => 
    array (
      'type' => 'string',
      'description' => 'Fraction alias domain mail',
    ),
     'aliasEmail' => 
    array (
      'type' => 'string',
      'description' => 'Franction alias account email',
    ),
  ),
  'required' => 
  array (
    0 => 'reference',
    1 => 'domainAlias',
    2 => 'aliasEmail',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_removealiasdomain',
                'Remove specific alias domain',
                'DELETE',
                '/api/managedmailprofessional/{reference}/contract/{domain}/domain/alias/{aliasDomain}/domain',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'reference' => 
    array (
      'type' => 'string',
      'description' => 'Contract name reference',
    ),
     'domain' => 
    array (
      'type' => 'string',
      'description' => 'domain name',
    ),
     'aliasDomain' => 
    array (
      'type' => 'string',
      'description' => 'alias name to remove',
    ),
  ),
  'required' => 
  array (
    0 => 'reference',
    1 => 'domain',
    2 => 'aliasDomain',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_createaliasondominio',
                'Create new alias on specific domain',
                'POST',
                '/api/managedmailprofessional/domain/alias/new',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'newAliasDomainRequest' => 
    array (
      'type' => 'string',
      'description' => 'Alias domain detail to update',
    ),
  ),
  'required' => 
  array (
    0 => 'newAliasDomainRequest',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_createaliasonmail',
                'Create new alias on specific emailbox',
                'POST',
                '/api/managedmailprofessional/email/alias/new',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'sMailBoxNewAliasRequest' => 
    array (
      'type' => 'string',
      'description' => 'Email alias detail to update',
    ),
  ),
  'required' => 
  array (
    0 => 'sMailBoxNewAliasRequest',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_getdomainlistmailboxesusedspace',
                'Get MailBoxes Used Space',
                'GET',
                '/api/managedmailprofessional/{reference}/contract/{domain}/domain/orderbyfield/{orderByField}/take/{take}/skip/{skip}/usedspace',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'reference' => 
    array (
      'type' => 'string',
      'description' => 'Contract reference',
    ),
     'domain' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
     'orderByField' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
     'take' => 
    array (
      'type' => 'integer',
      'description' => '',
    ),
     'skip' => 
    array (
      'type' => 'integer',
      'description' => '',
    ),
     'filterEmail' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
  ),
  'required' => 
  array (
    0 => 'reference',
    1 => 'domain',
    2 => 'orderByField',
    3 => 'take',
    4 => 'skip',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_getsearchemailsdomain',
                'Get email list on specific domain',
                'GET',
                '/api/managedmailprofessional/domain/emails',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'search.reference' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
     'search.domain' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
     'search.skip' => 
    array (
      'type' => 'integer',
      'description' => '',
    ),
     'search.take' => 
    array (
      'type' => 'integer',
      'description' => '',
    ),
     'search.filterEmail' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
  ),
  'required' => 
  array (
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_passwordmanagement',
                'Password management',
                'PUT',
                '/api/managedmailprofessional/contract/mail/PasswordManagement',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'passwordManagementInput' => 
    array (
      'type' => 'boolean',
      'description' => 'Details password management',
    ),
  ),
  'required' => 
  array (
    0 => 'passwordManagementInput',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'managedmailprofessional_managedmailprofessional_passwordexpirationaction',
                'Password expiration',
                'PUT',
                '/api/managedmailprofessional/contract/mail/PasswordExpiration',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'passwordExpirationInput' => 
    array (
      'type' => 'boolean',
      'description' => 'Details password management',
    ),
  ),
  'required' => 
  array (
    0 => 'passwordExpirationInput',
  ),
)
            ),
        ];
    }
}
