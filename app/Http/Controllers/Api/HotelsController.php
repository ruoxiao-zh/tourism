<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\HotelRequest;
use App\Models\Hotel;
use App\Models\HotelService;
use App\Transformers\HotelTransformer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HotelsController extends Controller
{
    public function store(HotelRequest $request, Hotel $hotel, HotelService $hotelService)
    {
        \DB::transaction(function () use ($request, $hotel, $hotelService) {
            $hotel->fill($request->all());
            $hotel->save();

            $hotel_services = json_decode($request->services, true);
            foreach ($hotel_services as $key => $value) {
                $hotelService->insert([
                    'service_name' => $value['service'],
                    'hotel_id'     => $hotel->id,
                    'created_at'   => Carbon::now(),
                    'updated_at'   => Carbon::now()
                ]);
            }
        });

        return $this->response->item($hotel, new HotelTransformer())
            ->setStatusCode(201);
    }

    public function update(HotelRequest $request, Hotel $hotel, HotelService $hotelService)
    {
        \DB::transaction(function () use ($request, $hotel, $hotelService) {
            $hotel->update($request->all());

            $hotelService->where('hotel_id', $hotel->id)->delete();
            $hotel_services = json_decode($request->services, true);
            foreach ($hotel_services as $key => $value) {
                $hotelService->insert([
                    'service_name' => $value['service'],
                    'hotel_id'     => $hotel->id,
                    'created_at'   => Carbon::now(),
                    'updated_at'   => Carbon::now()
                ]);
            }
        });

        return $this->response->item($hotel, new HotelTransformer());
    }

    public function destroy(Hotel $hotel)
    {
        // todo...
        // $this->authorize('update', $topic);

        $hotel->update(['is_delete' => 1]);

        return $this->response->noContent();
    }

    public function index(Request $request, Hotel $hotel)
    {
        $query = $hotel->query();
        $hotels = $query->where('is_delete', 0)->paginate(15);

        return $this->response->paginator($hotels, new HotelTransformer());
    }

    public function show(Hotel $hotel)
    {
        return $this->response->item($hotel, new HotelTransformer());
    }
}
