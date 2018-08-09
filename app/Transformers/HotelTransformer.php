<?php

namespace App\Transformers;

use App\Models\Hotel;
use League\Fractal\TransformerAbstract;

class HotelTransformer extends TransformerAbstract
{
    public function transform(Hotel $hotel)
    {
        return [
            'id'         => $hotel->id,
            'name'       => $hotel->name,
            'image'      => $hotel->image,
            'province'   => $hotel->province,
            'city'       => $hotel->city,
            'county'     => $hotel->county,
            'detail'     => $hotel->detail,
            'longitude'  => $hotel->longitude,
            'latitude'   => $hotel->latitude,
            'contact'    => $hotel->contact,
            'introduce'  => $hotel->introduce,
            'cate_id'    => $hotel->cate_id,
            'category'   => $hotel->category->name,
            'is_index'   => (boolean)$hotel->is_index,
            'min_price'  => $hotel->getMinPrice(),
            'services'   => $hotel->services,
            'rooms'      => $hotel->rooms(),
            'created_at' => $hotel->created_at->toDateTimeString(),
            'updated_at' => $hotel->updated_at->toDateTimeString(),
        ];
    }
}
