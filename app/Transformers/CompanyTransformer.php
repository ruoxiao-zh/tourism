<?php

namespace App\Transformers;

use App\Models\Company;
use League\Fractal\TransformerAbstract;

class CompanyTransformer extends TransformerAbstract
{
    public function transform(Company $company)
    {
        return [
            'id'         => $company->id,
            'name'       => $company->name,
            'phone'      => $company->phone,
            'address'    => $company->address,
            'introduce'  => $company->introduce,
            'created_at' => $company->created_at->toDateTimeString(),
            'updated_at' => $company->updated_at->toDateTimeString(),
        ];
    }
}
