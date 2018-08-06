<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckCoderOrder extends Model
{
    protected $table = 'check_coder_orders';

    protected $fillable = [
        'check_coder_id',
        'order_id',
        'status',
    ];
}
