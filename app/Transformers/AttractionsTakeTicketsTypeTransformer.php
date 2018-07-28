<?php

namespace App\Transformers;

use App\Models\AttractionsTakeTicketsType;
use League\Fractal\TransformerAbstract;

class AttractionsTakeTicketsTypeTransformer extends TransformerAbstract
{
    public function transform(AttractionsTakeTicketsType $attractionsTakeTicketsType)
    {
        return [
            'id'         => $attractionsTakeTicketsType->id,
            'name'       => $attractionsTakeTicketsType->name,
            'created_at' => $attractionsTakeTicketsType->created_at->toDateTimeString(),
            'updated_at' => $attractionsTakeTicketsType->updated_at->toDateTimeString(),
        ];
    }
}
