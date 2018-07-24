<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelVideo extends Model
{
    protected $table = 'travel_videos';

    protected $fillable = [
        'video',
        'type'
    ];
}
