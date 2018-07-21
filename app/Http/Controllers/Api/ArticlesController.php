<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ArticleRequest;
use App\Models\Article;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->save();

        return $this->response->item($article, new ArticleTransformer())
            ->setStatusCode(201);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        // todo...
        // $this->authorize('update', $topic);
        $article->update($request->all());
        return $this->response->item($article, new ArticleTransformer());
    }

    public function destroy(Article $article)
    {
        // todo...
        // $this->authorize('update', $topic);

        $article->delete();
        return $this->response->noContent();
    }

    public function index(ArticleRequest $request, Article $article)
    {
        $query = $article->query();
        $article = $query->where('type', $request->type)->paginate(15);

        return $this->response->paginator($article, new ArticleTransformer());
    }

    public function show(Article $article)
    {
        return $this->response->item($article, new ArticleTransformer());
    }
}