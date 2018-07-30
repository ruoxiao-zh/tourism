<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    protected $table = 'slideshows';

    protected $fillable = ['image'];
}
