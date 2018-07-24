<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelLineImage extends Model
{
    protected $table = 'travel_line_images';

    protected $fillable = [
        'image',
        'travel_line_id',
    ];
}
