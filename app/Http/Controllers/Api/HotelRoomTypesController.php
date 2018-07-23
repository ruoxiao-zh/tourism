<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\HotelRoomTypeRequest;
use App\Models\HotelRoomType;
use App\Transformers\HotelRoomTypeTransformer;
use Illuminate\Http\Request;

/**
 * 房间类型管理
 *
 * Class HotelRoomTypesController
 * @package App\Http\Controllers\Api
 */
class HotelRoomTypesController extends Controller
{
    public function store(HotelRoomTypeRequest $request, HotelRoomType $hotelRoomType)
    {
        $hotelRoomType->fill($request->all());
        $hotelRoomType->save();

        return $this->response->item($hotelRoomType, new HotelRoomTypeTransformer())
            ->setStatusCode(201);
    }

    public function update(HotelRoomTypeRequest $request, HotelRoomType $hotelRoomType)
    {
        // todo...
        // $this->authorize('update', $topic);
        $hotelRoomType->update($request->all());

        return $this->response->item($hotelRoomType, new HotelRoomTypeTransformer());
    }

    public function destroy(HotelRoomType $hotelRoomType)
    {
        // todo...
        // $this->authorize('update', $topic);

        $hotelRoomType->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, HotelRoomType $hotelRoomType)
    {
        $query = $hotelRoomType->query();
        $hotelRoomTypes = $query->paginate(15);

        return $this->response->paginator($hotelRoomTypes, new HotelRoomTypeTransformer());
    }

    public function show(HotelRoomType $hotelRoomType)
    {
        return $this->response->item($hotelRoomType, new HotelRoomTypeTransformer());
    }
}
