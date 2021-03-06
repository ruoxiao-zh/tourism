<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TravelLineRequest;
use App\Models\TravelCategory;
use App\Models\TravelLine;
use App\Models\TravelLineImage;
use App\Transformers\TravelLineTransformer;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * 旅游线路管理
 *
 * Class TravelLinesController
 * @package App\Http\Controllers\Api
 */
class TravelLinesController extends Controller
{
    public function store(TravelLineRequest $request, TravelLine $travelLine, TravelLineImage $travelLineImage)
    {
        \DB::transaction(function () use ($request, $travelLine, $travelLineImage) {
            $travelLine->fill($request->all());
            $travelLine->save();

            $travel_line_images = json_decode($request->images, true);
            foreach ($travel_line_images as $key => $value) {
                $travelLineImage->insert([
                    'image'          => $value['image'],
                    'travel_line_id' => $travelLine->id,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now()
                ]);
            }
        });

        return $this->response->item($travelLine, new TravelLineTransformer())
            ->setStatusCode(201);
    }

    public function update(TravelLineRequest $request, TravelLine $travelLine, TravelLineImage $travelLineImage)
    {
        \DB::transaction(function () use ($request, $travelLine, $travelLineImage) {
            $travelLine->update($request->all());

            $travelLineImage->where('travel_line_id', $travelLine->id)->delete();
            $travel_line_images = json_decode($request->images, true);
            foreach ($travel_line_images as $key => $value) {
                $travelLineImage->insert([
                    'image'          => $value['image'],
                    'travel_line_id' => $travelLine->id,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now()
                ]);
            }
        });

        return $this->response->item($travelLine, new TravelLineTransformer());
    }

    public function destroy(TravelLine $travelLine)
    {
        // todo...
        // $this->authorize('update', $topic);

        $travelLine->update(['is_delete' => 1]);

        return $this->response->noContent();
    }

    public function frontIndex(Request $request, TravelLine $travelLine)
    {
        $query = $travelLine->query();
        // 搜索条件
        $search_array = [];
        if ($request->name) {
            array_push($search_array, ['name', 'like', '%' . $request->name . '%']);
        }
        if ($request->index) {
            array_push($search_array, ['is_index', 1]);
        }
        $travelLines = $query->where('is_delete', 0)->where($search_array)->paginate(15);

        return $this->response->paginator($travelLines, new TravelLineTransformer());
    }

    public function index(Request $request, TravelLine $travelLine)
    {
        $query = $travelLine->query();
        // 搜索条件
        $search_array = [];
        if ($request->name) {
            array_push($search_array, ['name', 'like', '%' . $request->name . '%']);
        }
        if ($request->index) {
            array_push($search_array, ['is_index', 1]);
        }
        $travelLines = $query->where('is_delete', 0)->where('status', 0)->where($search_array)->paginate(15);

        return $this->response->paginator($travelLines, new TravelLineTransformer());
    }

    public function show(TravelLine $travelLine)
    {
        return $this->response->item($travelLine, new TravelLineTransformer());
    }

    public function changeStatus(TravelLine $travelLine)
    {
        if ($travelLine->status) {
            $travelLine->status = 0;
        } else {
            $travelLine->status = 1;
        }
        $travelLine->save();

        return $this->response->item($travelLine, new TravelLineTransformer());
    }

    public function changeIndex(TravelLine $travelLine)
    {
        if ($travelLine->is_index) {
            $travelLine->is_index = 0;
        } else {
            $travelLine->is_index = 1;
        }
        $travelLine->save();

        return $this->response->item($travelLine, new TravelLineTransformer());
    }

    public function categoryTravelLines(Request $request, TravelCategory $travelCategory)
    {
        $travelLines = $travelCategory->travelLines()->where('is_delete', 0)->where('status', 0)->paginate(15);

        return $this->response->paginator($travelLines, new TravelLineTransformer());
    }
}
