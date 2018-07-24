<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\HotelRoomRequest;
use App\Models\HotelRoom;
use App\Models\HotelRoomImage;
use App\Transformers\HotelRoomTransformer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HotelRoomsController extends Controller
{
    public function store(HotelRoomRequest $request, HotelRoom $hotelRoom, HotelRoomImage $hotelRoomImage)
    {
        \DB::transaction(function () use ($request, $hotelRoom, $hotelRoomImage) {
            $hotelRoom->fill($request->all());
            $hotelRoom->save();

            $hotel_images = json_decode($request->images, true);
            foreach ($hotel_images as $key => $value) {
                $hotelRoomImage->insert([
                    'image'         => $value['image'],
                    'hotel_room_id' => $hotelRoom->id,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]);
            }
        });

        return $this->response->item($hotelRoom, new HotelRoomTransformer())
            ->setStatusCode(201);
    }

    public function update(HotelRoomRequest $request, HotelRoom $hotelRoom, HotelRoomImage $hotelRoomImage)
    {
        \DB::transaction(function () use ($request, $hotelRoom, $hotelRoomImage) {
            $hotelRoom->update($request->all());

            $hotelRoomImage->where('hotel_room_id', $hotelRoom->id)->delete();
            $hotel_images = json_decode($request->images, true);
            foreach ($hotel_images as $key => $value) {
                $hotelRoomImage->insert([
                    'image'         => $value['image'],
                    'hotel_room_id' => $hotelRoom->id,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now()
                ]);
            }
        });

        return $this->response->item($hotelRoom, new HotelRoomTransformer());
    }

    public function destroy(HotelRoom $hotelRoom, HotelRoomImage $hotelRoomImage)
    {
        // todo...
        // $this->authorize('update', $topic);

        $hotelRoom->delete();
        $hotelRoomImage->where('hotel_room_id', $hotelRoom->id)->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, HotelRoom $hotelRoom)
    {
        $query = $hotelRoom->query();
        $hotelRooms = $query->paginate(15);

        return $this->response->paginator($hotelRooms, new HotelRoomTransformer());
    }

    public function show(HotelRoom $hotelRoom)
    {
        return $this->response->item($hotelRoom, new HotelRoomTransformer());
    }
}
