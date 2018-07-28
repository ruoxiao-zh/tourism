<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttractionsTakeTicketsType extends Model
{
    protected $table = 'attractions_take_tickets_types';

    protected $fillable = ['name'];
}
