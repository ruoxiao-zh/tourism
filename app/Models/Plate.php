<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $table = 'plate';

    protected $fillable = ['name', 'image', 'url'];
}
