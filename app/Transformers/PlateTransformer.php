<?php

namespace App\Transformers;

use App\Models\Plate;
use League\Fractal\TransformerAbstract;

class PlateTransformer extends TransformerAbstract
{
    public function transform(Plate $plate)
    {
        return [
            'id'         => $plate->id,
            'name'       => $plate->name,
            'image'      => $plate->image,
            'url'        => $plate->url,
            'created_at' => $plate->created_at->toDateTimeString(),
            'updated_at' => $plate->updated_at->toDateTimeString(),
        ];
    }
}
