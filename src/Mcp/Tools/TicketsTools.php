<?php

namespace App\Mcp\Tools;

use App\Service\ArubaBusinessClient;

readonly class TicketsTools
{
    public function __construct(private ArubaBusinessClient $client) {}

    public function getAll(): array
    {
        return [
            new GenericArubaTool(
                $this->client,
                'tickets_tickets_getticketsclient',
                'Retrieve list of tickets (paged)',
                'GET',
                '/api/tickets',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'filter.page' => 
    array (
      'type' => 'integer',
      'description' => '',
    ),
     'filter.status' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
     'filter.searchstring' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
  ),
  'required' => 
  array (
    0 => 'filter.page',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'tickets_tickets_newticket',
                'New ticket',
                'POST',
                '/api/tickets',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'newTicketInput' => 
    array (
      'type' => 'integer',
      'description' => 'Ticket details',
    ),
  ),
  'required' => 
  array (
    0 => 'newTicketInput',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'tickets_tickets_addmessagetoticket',
                'Add message to ticket',
                'POST',
                '/api/tickets/messages',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'messageTicket' => 
    array (
      'type' => 'number',
      'description' => 'Ticket message',
    ),
  ),
  'required' => 
  array (
    0 => 'messageTicket',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'tickets_tickets_addattachmenttomessage',
                'Add attachment to ticket message',
                'POST',
                '/api/tickets/messages/attachments',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'Input' => 
    array (
      'type' => 'integer',
      'description' => 'JSON field (serialized)',
    ),
     'file' => 
    array (
      'type' => 'string',
      'description' => 'File to upload',
    ),
  ),
  'required' => 
  array (
    0 => 'Input',
    1 => 'file',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'tickets_tickets_getcategories',
                'Finds all categories that can be associated to a ticket',
                'GET',
                '/api/tickets/categories',
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
                'tickets_tickets_getticket',
                'Get ticket details',
                'GET',
                '/api/tickets/{TicketNumber}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'TicketNumber' => 
    array (
      'type' => 'string',
      'description' => '',
    ),
  ),
  'required' => 
  array (
    0 => 'TicketNumber',
  ),
)
            ),
            new GenericArubaTool(
                $this->client,
                'tickets_tickets_getattachment',
                'Retrieves the specified attachment associated with a ticket.',
                'GET',
                '/api/tickets/{TicketNumber}/attachments/{AttachmentId}',
                array (
  'type' => 'object',
  'properties' => 
  (object) array(
     'TicketNumber' => 
    array (
      'type' => 'string',
      'description' => 'The unique identifier of the ticket to which the attachment belongs. Cannot be null or empty.',
    ),
     'AttachmentId' => 
    array (
      'type' => 'string',
      'description' => 'The unique identifier of the attachment to retrieve.',
    ),
  ),
  'required' => 
  array (
    0 => 'TicketNumber',
    1 => 'AttachmentId',
  ),
)
            ),
        ];
    }
}
