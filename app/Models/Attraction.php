<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    protected $table = 'attractions';

    protected $fillable = [
        'name',
        'image',
        'province',
        'city',
        'county',
        'detail',
        'longitude',
        'latitude',
        'date',
        'introduce',
        'take_tickets_type_id',
        'is_delete'
    ];

    public function takeTicketsType()
    {
        return $this->belongsTo(AttractionsTakeTicketsType::class, 'take_tickets_type_id', 'id');
    }

    public function tickets()
    {
        $tickets = Ticket::where('attraction_id', $this->id)->get();
        if ($tickets) {
            foreach ($tickets as $key => $ticket) {
                $ticket_type = TicketType::where('id', $ticket->ticket_type_id)->get();
                ($tickets[$key])->ticket_type = $ticket_type;
            }
        }

        return $tickets;
    }
}
