<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AttractionsTakeTicketsTypeRequest;
use App\Models\Attraction;
use App\Models\AttractionsTakeTicketsType;
use App\Transformers\AttractionsTakeTicketsTypeTransformer;
use Illuminate\Http\Request;

/**
 * 取票方式管理
 *
 * Class AttractionsTakeTicketsTypesController
 * @package App\Http\Controllers\Api
 */
class AttractionsTakeTicketsTypesController extends Controller
{
    public function store(AttractionsTakeTicketsTypeRequest $request, AttractionsTakeTicketsType $attractionsTakeTicketsType)
    {
        $attractionsTakeTicketsType->fill($request->all());
        $attractionsTakeTicketsType->save();

        return $this->response->item($attractionsTakeTicketsType, new AttractionsTakeTicketsTypeTransformer())
            ->setStatusCode(201);
    }

    public function update(AttractionsTakeTicketsTypeRequest $request, AttractionsTakeTicketsType $attractionsTakeTicketsType)
    {
        $attractionsTakeTicketsType->update($request->all());

        return $this->response->item($attractionsTakeTicketsType, new AttractionsTakeTicketsTypeTransformer());
    }

    public function destroy(AttractionsTakeTicketsType $attractionsTakeTicketsType)
    {
        $result = Attraction::where('take_tickets_type_id', $attractionsTakeTicketsType->id)->get();
        if (!$result->isEmpty()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('请先删除该取票方式下边的景点, 再删除该分类');
        }

        $attractionsTakeTicketsType->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, AttractionsTakeTicketsType $attractionsTakeTicketsType)
    {
        $query = $attractionsTakeTicketsType->query();
        $attractionsTakeTicketsTypes = $query->paginate(15);

        return $this->response->paginator($attractionsTakeTicketsTypes, new AttractionsTakeTicketsTypeTransformer());
    }

    public function show(AttractionsTakeTicketsType $attractionsTakeTicketsType)
    {
        return $this->response->item($attractionsTakeTicketsType, new AttractionsTakeTicketsTypeTransformer());
    }
}
