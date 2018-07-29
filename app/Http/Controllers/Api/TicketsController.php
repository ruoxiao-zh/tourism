<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TicketRequest;
use App\Models\Ticket;
use App\Transformers\TicketTransformer;
use Illuminate\Http\Request;

/**
 * 门票管理
 *
 * Class TicketsController
 * @package App\Http\Controllers\Api
 */
class TicketsController extends Controller
{
    public function store(TicketRequest $request, Ticket $ticket)
    {
        $ticket->fill($request->all());
        $ticket->save();

        return $this->response->item($ticket, new TicketTransformer())
            ->setStatusCode(201);
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        // todo...
        // $this->authorize('update', $topic);
        $ticket->update($request->all());

        return $this->response->item($ticket, new TicketTransformer());
    }

    public function destroy(Ticket $ticket)
    {
        // todo...
        // $this->authorize('update', $topic);

        $ticket->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, Ticket $ticket)
    {
        $query = $ticket->query();
        $tickets = $query->paginate(15);

        return $this->response->paginator($tickets, new TicketTransformer());
    }

    public function show(Ticket $ticket)
    {
        return $this->response->item($ticket, new TicketTransformer());
    }
}
