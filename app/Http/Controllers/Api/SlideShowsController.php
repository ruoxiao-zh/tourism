<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\SlideShowRequest;
use App\Models\SlideShow;
use App\Transformers\SlideShowTransformer;
use Illuminate\Http\Request;

/**
 * 轮播图管理
 *
 * Class SlideShowsController
 * @package App\Http\Controllers\Api
 */
class SlideShowsController extends Controller
{
    public function store(SlideShowRequest $request, SlideShow $slideShow)
    {
        $slideShow->fill($request->all());
        $slideShow->save();

        return $this->response->item($slideShow, new SlideShowTransformer())
            ->setStatusCode(201);
    }

    public function update(SlideShowRequest $request, SlideShow $slideShow)
    {
        // todo...
        // $this->authorize('update', $topic);
        $slideShow->update($request->all());

        return $this->response->item($slideShow, new SlideShowTransformer());
    }

    public function destroy(SlideShow $slideShow)
    {
        // todo...
        // $this->authorize('update', $topic);

        $slideShow->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, SlideShow $slideShow)
    {
        $query = $slideShow->query();
        $slideShows = $query->paginate(15);

        return $this->response->paginator($slideShows, new SlideShowTransformer());
    }

    public function show(SlideShow $slideShow)
    {
        return $this->response->item($slideShow, new SlideShowTransformer());
    }
}
