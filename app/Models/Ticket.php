<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = ['attraction_id', 'ticket_type_id', 'price', 'stock', 'needs_to_know'];

    public function attraction()
    {
        return $this->belongsTo(Attraction::class, 'attraction_id', 'id');
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id', 'id');
    }
}
