<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\MembersRequest;
use App\Models\Member;
use App\Transformers\MembersTransformer;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function store(MembersRequest $request, Member $member)
    {
        $member->fill($request->all());
        $member->save();

        return $this->response->item($member, new MembersTransformer())
            ->setStatusCode(201);
    }

    public function update(MembersRequest $request, Member $member)
    {
        // todo...
        // $this->authorize('update', $topic);

        $member->update($request->all());

        return $this->response->item($member, new MembersTransformer());
    }

    public function destroy(Member $member)
    {
        // todo...
        // $this->authorize('update', $topic);

        $member->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, Member $member)
    {
        $query = $member->query();
        $members = $query->paginate(15);

        return $this->response->paginator($members, new MembersTransformer());
    }

    public function show(Member $member)
    {
        return $this->response->item($member, new MembersTransformer());
    }
}
