<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CustomerServiceRequest;
use App\Models\CustomerService;
use App\Transformers\CustomerServiceTransformer;
use Illuminate\Http\Request;

/**
 * 客服管理
 *
 * Class CustomerServicesController
 * @package App\Http\Controllers\Api
 */
class CustomerServicesController extends Controller
{
    public function store(CustomerServiceRequest $request, CustomerService $customerService)
    {
        $customerService->fill($request->all());
        $customerService->save();

        return $this->response->item($customerService, new CustomerServiceTransformer())
            ->setStatusCode(201);
    }

    public function update(CustomerServiceRequest $request, CustomerService $customerService)
    {
        // todo...
        // $this->authorize('update', $topic);

        $customerService->update($request->all());

        return $this->response->item($customerService, new CustomerServiceTransformer());
    }

    public function destroy(CustomerService $customerService)
    {
        // todo...
        // $this->authorize('update', $topic);

        $customerService->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, CustomerService $customerService)
    {
        $query = $customerService->query();
        $customerServices = $query->paginate(15);

        return $this->response->paginator($customerServices, new CustomerServiceTransformer());
    }

    public function show(CustomerService $customerService)
    {
        return $this->response->item($customerService, new CustomerServiceTransformer());
    }
}
