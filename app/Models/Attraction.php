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
}
