<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class OrdersTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'orders_orders_getorders',
                'Get client orders',
                'GET',
                '/api/orders/{year}/{month}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'year' => 
    array (
      'type' => 'integer',
      'description' => 'Year - parameter required, integer of the year',
    ),
     'month' => 
    array (
      'type' => 'integer',
      'description' => 'Month - parameter required, integer of the month',
    ),
  ),
  'required' => 
  array (
    0 => 'year',
    1 => 'month',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'orders_orders_getorderbyid',
                'Get order by ordercode',
                'GET',
                '/api/orders/{companyId}/{year}/{id}/detail/{loadRow}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'companyId' => 
    array (
      'type' => 'string',
      'description' => 'Company id - part of the ordercode',
    ),
     'year' => 
    array (
      'type' => 'integer',
      'description' => 'Year - part of the ordercode',
    ),
     'id' => 
    array (
      'type' => 'integer',
      'description' => 'Id - part of the ordercode',
    ),
     'loadRow' => 
    array (
      'type' => 'boolean',
      'description' => 'True to retrieve also item rows; False otherwise; default value is False',
    ),
  ),
  'required' => 
  array (
    0 => 'companyId',
    1 => 'year',
    2 => 'id',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'orders_orders_getpaymentmethods',
                'Get list of registered payment methods for the client',
                'GET',
                '/api/orders/payment/methods',
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
                'orders_orders_payorder',
                'Execute payment order passing order unique identifier and payment method type id',
                'POST',
                '/api/orders/payment',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'payOrder' => 
    array (
      'type' => 'integer',
      'description' => 'Order details',
    ),
  ),
  'required' => 
  array (
    0 => 'payOrder',
  ),
)
            ),
        ];
    }
}
