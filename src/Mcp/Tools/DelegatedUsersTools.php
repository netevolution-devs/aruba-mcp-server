<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class DelegatedUsersTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_getdelegateusers',
                'Get delegated user details',
                'GET',
                '/api/delegatedusers/{username}/detail',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'username' => 
    array (
      'type' => 'string',
      'description' => 'Username',
    ),
  ),
  'required' => 
  array (
    0 => 'username',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_getdelegateusers_0',
                'Get client delegated users',
                'GET',
                '/api/delegatedusers',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
  ),
  'required' => 
  array (
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_updatedelegateuser',
                'Update delegated user',
                'PUT',
                '/api/delegatedusers',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'delegateUserUpdateInput' => 
    array (
      'type' => 'string',
      'description' => 'delegated user content',
    ),
  ),
  'required' => 
  array (
    0 => 'delegateUserUpdateInput',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_insertdelegateuserstandard',
                'Add new delegated standard user',
                'POST',
                '/api/delegatedusers/standard',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'delegateuser' => 
    array (
      'type' => 'boolean',
      'description' => 'delegated user content',
    ),
  ),
  'required' => 
  array (
    0 => 'delegateuser',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_insertdelegateuserlimited',
                'Add new delegated limited user',
                'POST',
                '/api/delegatedusers/limited',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'delegateuser' => 
    array (
      'type' => 'boolean',
      'description' => 'delegated limited user content',
    ),
  ),
  'required' => 
  array (
    0 => 'delegateuser',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_sendnotificationchangepassword',
                'Send to delegated user email for change password',
                'POST',
                '/api/delegatedusers/ChangePassword/email',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'delegateUserChangePasswordInput' => 
    array (
      'type' => 'string',
      'description' => 'delegated user content',
    ),
  ),
  'required' => 
  array (
    0 => 'delegateUserChangePasswordInput',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_updateflagenabledelegateuser',
                'Enable-Disable delegated user',
                'PUT',
                '/api/delegatedusers/Enable',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'delegateUserEnableInput' => 
    array (
      'type' => 'boolean',
      'description' => 'delegated user content',
    ),
  ),
  'required' => 
  array (
    0 => 'delegateUserEnableInput',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_disableotpdelegateuser',
                'Disable delegated user OTP',
                'PUT',
                '/api/delegatedusers/OTP/Disactivate',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'delegateUserDisableOTP' => 
    array (
      'type' => 'string',
      'description' => 'delegated username',
    ),
  ),
  'required' => 
  array (
    0 => 'delegateUserDisableOTP',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_disableotpdelegateuser_0',
                'Update profile standard delegated user',
                'PUT',
                '/api/delegatedusers/profile',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'delegateUserUpdateProfile' => 
    array (
      'type' => 'string',
      'description' => 'delegated user detail input',
    ),
  ),
  'required' => 
  array (
    0 => 'delegateUserUpdateProfile',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'delegatedusers_delegatedusers_deletedelegateuser',
                'Delete delegated user',
                'DELETE',
                '/api/delegatedusers/{username}/username',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'username' => 
    array (
      'type' => 'string',
      'description' => 'Username',
    ),
  ),
  'required' => 
  array (
    0 => 'username',
  ),
)
            ),
        ];
    }
}
