<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TicketTypeRequest;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Transformers\TicketTypeTransformer;
use Illuminate\Http\Request;

/**
 * 取票方式管理
 *
 * Class TicketTypesController
 * @package App\Http\Controllers\Api
 */
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
        $ticketType->update($request->all());

        return $this->response->item($ticketType, new TicketTypeTransformer());
    }

    public function destroy(TicketType $ticketType)
    {
        $result = Ticket::where('ticket_type_id', $ticketType->id)->get();
        if (!$result->isEmpty()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('请先删除该门票类型下边的门票, 再执行操作');
        }

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
