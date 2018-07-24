<?php

namespace App\Transformers;

use App\Models\TravelCategory;
use League\Fractal\TransformerAbstract;

class TravelCategoryTransformer extends TransformerAbstract
{
    public function transform(TravelCategory $travelCategory)
    {
        return [
            'id'         => $travelCategory->id,
            'name'       => $travelCategory->name,
            'pid'        => (int)$travelCategory->pid,
            'created_at' => $travelCategory->created_at->toDateTimeString(),
            'updated_at' => $travelCategory->updated_at->toDateTimeString(),
        ];
    }
}
