<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CheckCoderRequest;
use App\Models\CheckCoder;
use App\Transformers\CheckCoderTransformer;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;

class CheckCodersController extends Controller
{
    public function store(CheckCoderRequest $request, CheckCoder $checkCoder)
    {
        $checkCoder->fill($request->all());
        $checkCoder->save();

        return $this->response->item($checkCoder, new CheckCoderTransformer())
            ->setStatusCode(201);
    }

    public function update(CheckCoderRequest $request, CheckCoder $checkCoder)
    {
        // todo...
        // $this->authorize('update', $topic);

        $checkCoder->update($request->all());

        return $this->response->item($checkCoder, new CheckCoderTransformer());
    }

    public function destroy(CheckCoder $checkCoder)
    {
        // todo...
        // $this->authorize('update', $topic);

        $checkCoder->delete();

        return $this->response->noContent();
    }

    public function index(CheckCoderRequest $request, CheckCoder $checkCoder)
    {
        $query = $checkCoder->query();
        $checkCoders = $query->where('type', $request->type)->paginate(15);

        return $this->response->paginator($checkCoders, new CheckCoderTransformer());
    }

    public function show(CheckCoder $checkCoder)
    {
        return $this->response->item($checkCoder, new CheckCoderTransformer());
    }

    public function changeStatus(CheckCoder $checkCoder)
    {
        if ($checkCoder->status) {
            $checkCoder->status = 0;
        } else {
            $checkCoder->status = 1;
        }
        $checkCoder->save();

        return $this->response->item($checkCoder, new CheckCoderTransformer());
    }

    public function sendMessage(CheckCoder $checkCoder, EasySms $easySms)
    {
        // 发送短信
        try {
            $easySms->send($checkCoder->phone, [
                'template' => env('ALIYUN_CHECK_CODER_TEMPLATE', ''),
                'data'     => [
                    'name' => $checkCoder->name,
                    'code' => $checkCoder->code
                ],
            ]);
        } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
            $message = $exception->getException('aliyun')->getMessage();

            return $this->response->errorInternal($message ?? '短信发送异常');
        }
    }
}
