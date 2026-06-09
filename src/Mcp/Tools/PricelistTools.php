<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class PricelistTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'pricelist_pricelist_getpricelist',
                'Get price list',
                'GET',
                '/api/pricelist',
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
        ];
    }
}
