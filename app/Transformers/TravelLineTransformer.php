<?php

namespace App\Transformers;

use App\Models\TravelLine;
use League\Fractal\TransformerAbstract;

class TravelLineTransformer extends TransformerAbstract
{
    public function transform(TravelLine $travelLine)
    {
        return [
            'id'         => $travelLine->id,
            'date'       => $travelLine->date,
            'name'       => $travelLine->name,
            'price'      => $travelLine->price,
            'cate_id'    => (int)$travelLine->cate_id,
            'category'   => $travelLine->category->name,
            'status'     => !(boolean)$travelLine->status,
            'images'     => $travelLine->images,
            'created_at' => $travelLine->created_at->toDateTimeString(),
            'updated_at' => $travelLine->updated_at->toDateTimeString(),
        ];
    }
}
