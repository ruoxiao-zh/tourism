<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TicketTypeRequest;
use App\Models\TicketType;
use App\Transformers\TicketTypeTransformer;
use Illuminate\Http\Request;

class TicketTypesController extends Controller
{
    public function store(TicketTypeRequest $request, TicketType $ticketType)
    {
        $ticketType->fill($request->all());
        $ticketType->save();

        return $this->response->item($ticketType, new TicketTypeTransformer())
            ->setStatusCode(201);
    }

    public function update(TicketTypeRequest $request, TicketType $ticketType)
    {
        // todo...
        // $this->authorize('update', $topic);
        $ticketType->update($request->all());

        return $this->response->item($ticketType, new TicketTypeTransformer());
    }

    public function destroy(TicketType $ticketType)
    {
        // todo...
        // $this->authorize('update', $topic);

        $ticketType->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, TicketType $ticketType)
    {
        $query = $ticketType->query();
        $ticketTypes = $query->paginate(15);

        return $this->response->paginator($ticketTypes, new TicketTypeTransformer());
    }

    public function show(TicketType $ticketType)
    {
        return $this->response->item($ticketType, new TicketTypeTransformer());
    }
}
