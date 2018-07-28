<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AttractionRequest;
use App\Models\Attraction;
use App\Transformers\AttractionTransformer;
use Illuminate\Http\Request;

class AttractionsController extends Controller
{
    public function store(AttractionRequest $request, Attraction $attraction)
    {
        $attraction->fill($request->all());
        $attraction->save();

        return $this->response->item($attraction, new AttractionTransformer())
            ->setStatusCode(201);
    }

    public function update(AttractionRequest $request, Attraction $attraction)
    {
        // todo...
        // $this->authorize('update', $topic);
        $attraction->update($request->all());
        return $this->response->item($attraction, new AttractionTransformer());
    }

    public function destroy(Attraction $attraction)
    {
        // todo...
        // $this->authorize('update', $topic);

        $attraction->update([
            'is_delete' => 1
        ]);

        return $this->response->noContent();
    }

    public function index(Request $request, Attraction $attraction)
    {
        $query = $attraction->query();
        $attractions = $query->where('is_delete', 0)->paginate(15);

        return $this->response->paginator($attractions, new AttractionTransformer());
    }

    public function show(Attraction $attraction)
    {
        return $this->response->item($attraction, new AttractionTransformer());
    }
}
