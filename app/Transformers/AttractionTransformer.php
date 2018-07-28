<?php

namespace App\Transformers;

use App\Models\Attraction;
use League\Fractal\TransformerAbstract;

class AttractionTransformer extends TransformerAbstract
{
    public function transform(Attraction $attraction)
    {
        return [
            'id'                   => $attraction->id,
            'name'                 => $attraction->name,
            'image'                => $attraction->image,
            'province'             => $attraction->province,
            'city'                 => $attraction->city,
            'county'               => $attraction->county,
            'detail'               => $attraction->detail,
            'longitude'            => (float)$attraction->longitude,
            'latitude'             => (float)$attraction->latitude,
            'date'                 => $attraction->date,
            'introduce'            => $attraction->introduce,
            'take_tickets_type_id' => (int)$attraction->take_tickets_type_id,
            'take_tickets_type'    => $attraction->takeTicketsType->name,
            'created_at'           => $attraction->created_at->toDateTimeString(),
            'updated_at'           => $attraction->updated_at->toDateTimeString(),
        ];
    }
}
