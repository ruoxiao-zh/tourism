<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'no',
        'order_id',
        'product_id',
        'amount',
        'price',
        'total_money',
        'type',
        'date',
    ];
}
