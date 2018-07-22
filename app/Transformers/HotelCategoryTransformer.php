<?php

namespace App\Transformers;

use App\Models\HotelCategory;
use League\Fractal\TransformerAbstract;

class HotelCategoryTransformer extends TransformerAbstract
{
    public function transform(HotelCategory $hotelCategory)
    {
        return [
            'id'         => $hotelCategory->id,
            'name'       => $hotelCategory->name,
            'pid'        => (int)$hotelCategory->pid,
            'created_at' => $hotelCategory->created_at->toDateTimeString(),
            'updated_at' => $hotelCategory->updated_at->toDateTimeString(),
        ];
    }
}
