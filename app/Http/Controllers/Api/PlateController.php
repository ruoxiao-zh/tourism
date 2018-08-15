<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PlateRequest;
use App\Models\Plate;
use App\Transformers\PlateTransformer;
use Illuminate\Http\Request;

class PlateController extends Controller
{
    public function store(PlateRequest $request, Plate $plate)
    {
        $plate->fill($request->all());
        $plate->save();

        return $this->response->item($plate, new PlateTransformer())
            ->setStatusCode(201);
    }

    public function update(PlateRequest $request, Plate $plate)
    {
        // todo...
        // $this->authorize('update', $topic);
        $plate->update($request->all());

        return $this->response->item($plate, new PlateTransformer());
    }

    public function destroy(Plate $plate)
    {
        // todo...
        // $this->authorize('update', $topic);

        $plate->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, Plate $plate)
    {
        $query = $plate->query();
        $plates = $query->paginate(15);

        return $this->response->paginator($plates, new PlateTransformer());
    }

    public function show(Plate $plate)
    {
        return $this->response->item($plate, new PlateTransformer());
    }
}
