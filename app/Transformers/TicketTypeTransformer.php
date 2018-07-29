<?php

namespace App\Transformers;

use App\Models\TicketType;
use League\Fractal\TransformerAbstract;

class TicketTypeTransformer extends TransformerAbstract
{
    public function transform(TicketType $ticketType)
    {
        return [
            'id'         => $ticketType->id,
            'name'       => $ticketType->name,
            'created_at' => $ticketType->created_at->toDateTimeString(),
            'updated_at' => $ticketType->updated_at->toDateTimeString(),
        ];
    }
}
