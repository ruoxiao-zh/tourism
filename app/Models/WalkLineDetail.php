<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalkLineDetail extends Model
{
    protected $table = 'walk_line_detail';

    protected $fillable = [
        'walk_id',
        'images',
        'introduce',
        'data',
    ];
}
