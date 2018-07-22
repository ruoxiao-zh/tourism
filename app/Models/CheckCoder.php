<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckCoder extends Model
{
    protected $table = 'check_coders';

    protected $fillable = [
        'name',
        'phone',
        'code',
        'type',
    ];
}
