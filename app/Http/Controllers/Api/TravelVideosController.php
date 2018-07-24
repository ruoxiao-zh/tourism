<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TravelVideoRequest;
use App\Models\TravelVideo;
use App\Transformers\TravelVideoTransformer;
use Illuminate\Http\Request;

/**
 * 旅游视频管理
 *
 * Class TravelVideosController
 * @package App\Http\Controllers\Api
 */
class TravelVideosController extends Controller
{
    public function store(TravelVideoRequest $request, TravelVideo $travelVideo)
    {
        $travelVideo->fill($request->all());
        $travelVideo->save();

        return $this->response->item($travelVideo, new TravelVideoTransformer())
            ->setStatusCode(201);
    }

    public function update(TravelVideoRequest $request, TravelVideo $travelVideo)
    {
        // todo...
        // $this->authorize('update', $topic);

        $travelVideo->update($request->all());

        return $this->response->item($travelVideo, new TravelVideoTransformer());
    }

    public function destroy(TravelVideo $travelVideo)
    {
        // todo...
        // $this->authorize('update', $topic);

        $travelVideo->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, TravelVideo $travelVideo)
    {
        $query = $travelVideo->query();
        $travelVideos = $query->paginate(15);

        return $this->response->paginator($travelVideos, new TravelVideoTransformer());
    }

    public function show(TravelVideo $travelVideo)
    {
        return $this->response->item($travelVideo, new TravelVideoTransformer());
    }
}
