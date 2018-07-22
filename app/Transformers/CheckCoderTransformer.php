<?php

namespace App\Transformers;

use App\Models\CheckCoder;
use League\Fractal\TransformerAbstract;

class CheckCoderTransformer extends TransformerAbstract
{
    public function transform(CheckCoder $checkCoder)
    {
        return [
            'id'         => $checkCoder->id,
            'name'       => $checkCoder->name,
            'phone'      => $checkCoder->phone,
            'code'       => $checkCoder->code,
            'type'       => $checkCoder->type,
            'status'     => (boolean)$checkCoder->status,
            'created_at' => $checkCoder->created_at->toDateTimeString(),
            'updated_at' => $checkCoder->updated_at->toDateTimeString(),
        ];
    }
}
