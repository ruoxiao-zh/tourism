<?php

namespace App\Transformers;

use App\Models\CustomerService;
use League\Fractal\TransformerAbstract;

class CustomerServiceTransformer extends TransformerAbstract
{
    public function transform(CustomerService $customerService)
    {
        return [
            'id'         => $customerService->id,
            'nickname'   => $customerService->nickname,
            'qrcode'     => $customerService->qrcode,
            'created_at' => $customerService->created_at->toDateTimeString(),
            'updated_at' => $customerService->updated_at->toDateTimeString(),
        ];
    }
}
