<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class CartsTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'carts_carts_getcart',
                'Get specific client cart',
                'GET',
                '/api/carts/{id}/{all}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'id' => 
    array (
      'type' => 'string',
      'description' => 'Cart id',
    ),
     'all' => 
    array (
      'type' => 'boolean',
      'description' => 'True to retrieve all details; False otherwise; The default value is False',
    ),
  ),
  'required' => 
  array (
    0 => 'id',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'carts_carts_getcarts',
                'Get client carts',
                'GET',
                '/api/carts/{all}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'all' => 
    array (
      'type' => 'boolean',
      'description' => 'True to retrieve all details; False otherwise; The default value is False',
    ),
  ),
  'required' => 
  array (
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'carts_carts_postcart',
                'Create new cart',
                'POST',
                '/api/carts',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'string',
      'description' => 'Optional custom id associated to the cart',
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
                'carts_carts_deletecart',
                'Delete cart',
                'DELETE',
                '/api/carts/{id}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'id' => 
    array (
      'type' => 'string',
      'description' => 'Cart id',
    ),
  ),
  'required' => 
  array (
    0 => 'id',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'carts_carts_getitem',
                'Get cart item',
                'GET',
                '/api/carts/item/{id}/{all}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'id' => 
    array (
      'type' => 'integer',
      'description' => 'Cart item id',
    ),
     'all' => 
    array (
      'type' => 'boolean',
      'description' => 'True to retrieve all details; False otherwise; The default value is False',
    ),
  ),
  'required' => 
  array (
    0 => 'id',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'carts_carts_adddomainitem',
                'Add domain item to cart',
                'POST',
                '/api/carts/item/domain',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'boolean',
      'description' => 'Domain item details',
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
                'carts_carts_addtransferitem',
                'Add transfer item to cart',
                'POST',
                '/api/carts/item/transfer',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'boolean',
      'description' => 'Domain item details to cart',
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
                'carts_carts_addpecitem',
                'Add pec item to cart',
                'POST',
                '/api/carts/item/pec',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'integer',
      'description' => 'pec item details to cart',
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
                'carts_carts_addexternaldomainitem',
                'Add external domain item to cart',
                'POST',
                '/api/carts/item/externalDomain',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'boolean',
      'description' => 'cloud hosting item details to cart',
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
                'carts_carts_addcloudhostingramupgradeitem',
                'Add Cloud hosting RAM Upgrade to cart, on a existing Cloud hosting plan',
                'POST',
                '/api/carts/item/CloudHostingRAMUpgrade',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'integer',
      'description' => 'Cloud hosting RAM Upgrade item details to cart',
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
                'carts_carts_addcloudhostingextracpuupgradeitem',
                'Add Cloud hosting extra CPU Upgrade to cart, on a existing Linux Cloud hosting plan',
                'POST',
                '/api/carts/item/CloudHostingExtraCPUUpgrade',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'model' => 
    array (
      'type' => 'integer',
      'description' => 'Cloud hosting extra CPU Upgrade item details to cart',
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
                'carts_carts_deletecartitem',
                'Delete cart item',
                'DELETE',
                '/api/carts/item/{id}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'id' => 
    array (
      'type' => 'integer',
      'description' => 'Cart item id',
    ),
  ),
  'required' => 
  array (
    0 => 'id',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'carts_carts_finalize',
                'Finalize cart',
                'POST',
                '/api/carts/finalize/{idCart}/{idSubscription}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idCart' => 
    array (
      'type' => 'string',
      'description' => 'Cart id',
    ),
     'idSubscription' => 
    array (
      'type' => 'string',
      'description' => 'Submit acceptances reference id',
    ),
  ),
  'required' => 
  array (
    0 => 'idCart',
    1 => 'idSubscription',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'carts_carts_getrequiredacceptance',
                'Get required acceptances list to finalize cart',
                'GET',
                '/api/carts/acceptances/{id}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'id' => 
    array (
      'type' => 'string',
      'description' => 'Cart id',
    ),
  ),
  'required' => 
  array (
    0 => 'id',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'carts_carts_postrequiredacceptance',
                'Set subscription contracts',
                'POST',
                '/api/carts/acceptances',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'modelAcceptance' => 
    array (
      'type' => 'boolean',
      'description' => 'Submit acceptances',
    ),
  ),
  'required' => 
  array (
    0 => 'modelAcceptance',
  ),
)
            ),
        ];
    }
}
