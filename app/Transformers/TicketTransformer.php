<?php

namespace App\Transformers;

use App\Models\Ticket;
use League\Fractal\TransformerAbstract;

class TicketTransformer extends TransformerAbstract
{
    public function transform(Ticket $ticket)
    {
        return [
            'id'             => $ticket->id,
            'attraction_id'  => (int)$ticket->attraction_id,
            'attraction'     => $ticket->attraction ? $ticket->attraction->name : '',
            'ticket_type_id' => (int)$ticket->ticket_type_id,
            'ticket_type'    => $ticket->ticketType ? $ticket->ticketType->name : '',
            'stock'          => (int)$ticket->stock,
            'price'          => $ticket->price,
            'needs_to_know'  => $ticket->needs_to_know,
            'created_at'     => $ticket->created_at->toDateTimeString(),
            'updated_at'     => $ticket->updated_at->toDateTimeString(),
        ];
    }
}
