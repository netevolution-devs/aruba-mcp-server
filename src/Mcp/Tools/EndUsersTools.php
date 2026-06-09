<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class EndUsersTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'endusers_endusers_deleteenduser',
                'Delete enduser',
                'DELETE',
                '/api/endusers/{username}/username',
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
                'endusers_endusers_getendusers',
                'Get enduser details',
                'GET',
                '/api/endusers/{username}/username',
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
                'endusers_endusers_getendusers_0',
                'Get client endusers',
                'GET',
                '/api/endusers',
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
                'endusers_endusers_insertendusers',
                'Add new enduser',
                'POST',
                '/api/endusers',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'enduser' => 
    array (
      'type' => 'integer',
      'description' => 'Enduser content',
    ),
  ),
  'required' => 
  array (
    0 => 'enduser',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'endusers_endusers_updatefullenduser',
                'Update enduser',
                'PUT',
                '/api/endusers',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'enduser' => 
    array (
      'type' => 'integer',
      'description' => 'Enduser content',
    ),
  ),
  'required' => 
  array (
    0 => 'enduser',
  ),
)
            ),
        ];
    }
}
