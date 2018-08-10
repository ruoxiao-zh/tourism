<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\WalkRequest;
use App\Models\WalkLine;
use App\Models\WalkLineDetail;
use App\Transformers\WalkTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalkController extends Controller
{
    public function store(WalkRequest $request, WalkLine $walkLine, WalkLineDetail $walkLineDetail)
    {
        \DB::transaction(function () use ($request, $walkLine, $walkLineDetail) {
            $walkLine->fill($request->all());
            $walkLine->save();

            $walkLineDetail->insert([
                'walk_id'    => $walkLine->id,
                'images'     => $request->images,
                'introduce'  => $request->introduce,
                'data'       => $request->data,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        });

        return $this->response->item($walkLine, new WalkTransformer())
            ->setStatusCode(201);
    }

    public function update(WalkRequest $request, WalkLine $walkLine, WalkLineDetail $walkLineDetail)
    {
        \DB::transaction(function () use ($request, $walkLine, $walkLineDetail) {
            $walkLine->update($request->all());

            $walkLineDetail->where('walk_id', $walkLine->id)->delete();
            $walkLineDetail->insert([
                'walk_id'    => $walkLine->id,
                'images'     => $request->images,
                'introduce'  => $request->introduce,
                'data'       => $request->data,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        });

        return $this->response->item($walkLine, new WalkTransformer())
            ->setStatusCode(201);
    }

    public function destroy(WalkLine $walkLine, WalkLineDetail $walkLineDetail)
    {
        // todo...
        // $this->authorize('update', $topic);
        $walkLineDetail->where('walk_id', $walkLine->id)->delete();
        $walkLine->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, WalkLine $walkLine)
    {
        $query = $walkLine->query();
        $walkLines = $query->paginate(15);

        return $this->response->paginator($walkLines, new WalkTransformer());
    }

    public function show(WalkLine $walkLine)
    {
        return $this->response->item($walkLine, new WalkTransformer());
    }
}
