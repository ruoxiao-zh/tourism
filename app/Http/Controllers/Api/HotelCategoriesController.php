<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\HotelCategoryRequest;
use App\Models\HotelCategory;
use App\Models\Hotel;
use App\Transformers\HotelCategoryTransformer;
use Illuminate\Http\Request;

/**
 * 酒店分类管理
 *
 * Class HotelCategoriesController
 * @package App\Http\Controllers\Api]
 */
class HotelCategoriesController extends Controller
{
    public function store(HotelCategoryRequest $request, HotelCategory $hotelCategory)
    {
        $hotelCategory->fill($request->all());
        $hotelCategory->save();

        return $this->response->item($hotelCategory, new HotelCategoryTransformer())
            ->setStatusCode(201);
    }

    public function update(HotelCategoryRequest $request, HotelCategory $hotelCategory)
    {
        // todo...
        // $this->authorize('update', $topic);
        $hotelCategory->update($request->all());

        return $this->response->item($hotelCategory, new HotelCategoryTransformer());
    }

    public function destroy(HotelCategory $hotelCategory, Request $request)
    {
        // todo...
        // $this->authorize('update', $topic);
	if (Hotel::where('cate_id', $request->id)->get()) {
	    throw new \Dingo\Api\Exception\StoreResourceFailedException('请先删除该酒店分类下的酒店, 再执行操作');
	}

        $hotelCategory->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, HotelCategory $hotelCategory)
    {
        $query = $hotelCategory->query();
        $hotelCategories = $query->paginate(15);

        return $this->response->paginator($hotelCategories, new HotelCategoryTransformer());
    }

    public function show(HotelCategory $hotelCategory)
    {
        return $this->response->item($hotelCategory, new HotelCategoryTransformer());
    }
}
