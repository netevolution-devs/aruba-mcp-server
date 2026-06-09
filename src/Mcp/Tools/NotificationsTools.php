<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class NotificationsTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'notifications_notifications_getnotificationsbyservice',
                'Notification list and total details notifications not read by idService and current calling idClient',
                'GET',
                '/api/Notifications/services/{idService}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idService' => 
    array (
      'type' => 'integer',
      'description' => 'Id of the service',
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
                'notifications_notifications_getnotificationbyidforswagger',
                'Notification by idNotification and current calling idClient',
                'GET',
                '/api/Notifications/{idNotification}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idNotification' => 
    array (
      'type' => 'integer',
      'description' => 'Id of the notification',
    ),
  ),
  'required' => 
  array (
    0 => 'idNotification',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'notifications_notifications_getnews',
                'Get News of type alert broadcast.',
                'GET',
                '/api/Notifications/News/pageindex/{pageIndex}/pagesize/{pageSize}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'pageIndex' => 
    array (
      'type' => 'integer',
      'description' => '',
    ),
     'pageSize' => 
    array (
      'type' => 'integer',
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
                'notifications_notifications_getnumbertobedelivered',
                'Retrieve the client\'s number of notification to be delivered',
                'GET',
                '/api/Notifications/ToBeDelivered',
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
                'notifications_notifications_notificationchangestatus',
                'Change state of specific notification passed as input',
                'PUT',
                '/api/Notifications/Status/{idNotification}/{state}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'idNotification' => 
    array (
      'type' => 'integer',
      'description' => 'Notification id',
    ),
     'state' => 
    array (
      'type' => 'string',
      'description' => 'State to set for the notification',
    ),
  ),
  'required' => 
  array (
    0 => 'idNotification',
    1 => 'state',
  ),
)
            ),
        ];
    }
}
