<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TravelCategoryRequest;
use App\Models\TravelCategory;
use App\Transformers\TravelCategoryTransformer;
use Illuminate\Http\Request;

/**
 * 旅游分类管理
 *
 * Class TravelCategoriesController
 * @package App\Http\Controllers\Api
 */
class TravelCategoriesController extends Controller
{
    public function store(TravelCategoryRequest $request, TravelCategory $travelCategory)
    {
        $travelCategory->fill($request->all());
        $travelCategory->save();

        return $this->response->item($travelCategory, new TravelCategoryTransformer())
            ->setStatusCode(201);
    }

    public function update(TravelCategoryRequest $request, TravelCategory $travelCategory)
    {
        // todo...
        // $this->authorize('update', $topic);
        $travelCategory->update($request->all());

        return $this->response->item($travelCategory, new TravelCategoryTransformer());
    }

    public function destroy(TravelCategory $travelCategory)
    {
        // todo...
        // $this->authorize('update', $topic);

        $travelCategory->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, TravelCategory $travelCategory)
    {
        $query = $travelCategory->query();
        $travelCategories = $query->paginate(15);

        return $this->response->paginator($travelCategories, new TravelCategoryTransformer());
    }

    public function show(TravelCategory $travelCategory)
    {
        return $this->response->item($travelCategory, new TravelCategoryTransformer());
    }
}
