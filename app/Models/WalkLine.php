<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalkLine extends Model
{
    protected $table = 'walk_lines';

    protected $fillable = [
        'name',
        'image',
        'walk_category_id',
    ];
}
