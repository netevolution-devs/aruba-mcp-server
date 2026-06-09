<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class CustomersTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'customers_customers_password',
                'Change client password',
                'PATCH',
                '/api/customers/password',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'newPassword' => 
    array (
      'type' => 'string',
      'description' => 'New password',
    ),
  ),
  'required' => 
  array (
    0 => 'newPassword',
  ),
)
            ),
        ];
    }
}
