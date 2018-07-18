<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Transformers\CompanyTransformer;
use Illuminate\Http\Request;
use App\Http\Requests\Api\CompanyRequest;

/**
 * 公司管理
 *
 * Class CompaniesController
 * @package App\Http\Controllers\Api
 */
class CompaniesController extends Controller
{
    public function store(CompanyRequest $request, Company $company)
    {
        $company->fill($request->all());
        $company->save();

        return $this->response->item($company, new CompanyTransformer())
            ->setStatusCode(201);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        // todo...
        // $this->authorize('update', $topic);

        $company->update($request->all());
        return $this->response->item($company, new CompanyTransformer());
    }

    public function destroy(Company $company)
    {
        // todo...
        // $this->authorize('update', $topic);

        $company->delete();
        return $this->response->noContent();
    }

    public function index(Request $request, Company $company)
    {
        $query = $company->query();
        $companies = $query->paginate(15);

        return $this->response->paginator($companies, new CompanyTransformer());
    }

    public function show(Company $company)
    {
        return $this->response->item($company, new CompanyTransformer());
    }
}
