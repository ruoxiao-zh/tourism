<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\MemberTitleRequest;
use App\Models\MemberTitle;
use App\Transformers\MemberTitleTransformer;
use Illuminate\Http\Request;

/**
 * 会员头衔管理
 *
 * Class MemberTitleController
 * @package App\Http\Controllers\Api
 */
class MemberTitleController extends Controller
{
    public function store(MemberTitleRequest $request, MemberTitle $memberTitle)
    {
        $memberTitle->fill($request->all());
        $memberTitle->save();

        return $this->response->item($memberTitle, new MemberTitleTransformer())
            ->setStatusCode(201);
    }

    public function update(MemberTitleRequest $request, MemberTitle $memberTitle)
    {
        // todo...
        // $this->authorize('update', $topic);

        $memberTitle->update($request->all());

        return $this->response->item($memberTitle, new MemberTitleTransformer());
    }

    public function destroy(MemberTitle $memberTitle)
    {
        $result = MemberTitle::where('title_id', $memberTitle->id)->get();
        if (!$result->isEmpty()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('请先删除该会员头衔下的会员, 再执行操作');
        }

        $memberTitle->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, MemberTitle $memberTitle)
    {
        $query = $memberTitle->query();
        $memberTitles = $query->paginate(15);

        return $this->response->paginator($memberTitles, new MemberTitleTransformer());
    }

    public function show(MemberTitle $memberTitle)
    {
        return $this->response->item($memberTitle, new MemberTitleTransformer());
    }
}
