<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AddCartRequest;
use App\Models\Cart;
use App\Transformers\CartTransformer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(AddCartRequest $request)
    {
        if ($cart = Cart::where([
            'user_id'        => $this->user()->id,
            'type'           => $request->type,
            'product_sku_id' => $request->product_sku_id
        ])->first()) {
            $cart->update([
                'amount' => $cart->amount + $request->amount,
            ]);
        } else {
            $data = array_merge($request->all(), ['user_id' => $this->user()->id]);
            $cart = new Cart();
            $cart->fill($data);
            $cart->save();
        }

        return $this->response->item($cart, new CartTransformer())
            ->setStatusCode(201);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return $this->response->noContent();
    }

    public function index(Request $request, Cart $cart)
    {
        $query = $cart->query();
        $cart = $query->where('user_id', $this->user()->id)->paginate(15);

        return $this->response->paginator($cart, new CartTransformer());
    }

    public function show(Cart $cart)
    {
        return $this->response->item($cart, new CartTransformer());
    }
}
