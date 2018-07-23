<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ArticleCategoryRequest;
use App\Models\ArticleCategory;
use App\Transformers\ArticleCategoryTransformer;
use Illuminate\Http\Request;

/**
 * 文章分类管理
 *
 * Class ArticleCategoriesController
 * @package App\Http\Controllers\Api
 */
class ArticleCategoriesController extends Controller
{
    public function store(ArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        $articleCategory->fill($request->all());
        $articleCategory->save();

        return $this->response->item($articleCategory, new ArticleCategoryTransformer())
            ->setStatusCode(201);
    }

    public function update(ArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        // todo...
        // $this->authorize('update', $topic);
        $articleCategory->update($request->all());
        
        return $this->response->item($articleCategory, new ArticleCategoryTransformer());
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        // todo...
        // $this->authorize('update', $topic);

        $articleCategory->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, ArticleCategory $articleCategory)
    {
        $query = $articleCategory->query();
        $articleCategories = $query->where('type', $request->type)->paginate(15);

        return $this->response->paginator($articleCategories, new ArticleCategoryTransformer());
    }

    public function show(ArticleCategory $articleCategory)
    {
        return $this->response->item($articleCategory, new ArticleCategoryTransformer());
    }
}
