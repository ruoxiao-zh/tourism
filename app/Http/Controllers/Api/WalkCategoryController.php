<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\WalkCategoryRequest;
use App\Models\WalkCategory;
use App\Transformers\WalkCategoryTransformer;
use Illuminate\Http\Request;

class WalkCategoryController extends Controller
{
    public function store(WalkCategoryRequest $request, WalkCategory $walkCategory)
    {
        $walkCategory->fill($request->all());
        $walkCategory->save();

        return $this->response->item($walkCategory, new WalkCategoryTransformer())
            ->setStatusCode(201);
    }

    public function update(WalkCategoryRequest $request, WalkCategory $walkCategory)
    {
        // todo...
        // $this->authorize('update', $topic);
        $walkCategory->update($request->all());

        return $this->response->item($walkCategory, new WalkCategoryTransformer());
    }

    public function destroy(WalkCategory $walkCategory)
    {
        // todo...
        // $this->authorize('update', $topic);

        $walkCategory->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, WalkCategory $walkCategory)
    {
        $query = $walkCategory->query();
        $walkCategories = $query->paginate(15);

        return $this->response->paginator($walkCategories, new WalkCategoryTransformer());
    }

    public function show(WalkCategory $walkCategory)
    {
        return $this->response->item($walkCategory, new WalkCategoryTransformer());
    }
}
