<?php

namespace App\Transformers;

use App\Models\Cart;
use League\Fractal\TransformerAbstract;

class CartTransformer extends TransformerAbstract
{
    public function transform(Cart $cart)
    {
        switch ($cart->type) {
            case 'travel':
                return [
                    'id'                  => (int)$cart->id,
                    'user_id'             => (int)$cart->user_id,
                    'user_name'           => $cart->user ? $cart->user->nickname : '',
                    'amount'              => (int)$cart->amount,
                    'type'                => $cart->type,
                    'product_sku_id'      => (int)$cart->product_sku_id,
                    'product_name'        => $cart->travelProduct ? $cart->travelProduct->name : '',
                    'product_price'       => (float)$cart->travelProduct ? $cart->travelProduct->price : '',
                    'product_image'       => $cart->travelProductImage()->image,
                    'product_total_money' => $cart->product_total_money,
                    'date'                => json_decode($cart->date, true),
                    'created_at'          => $cart->created_at->toDateTimeString(),
                    'updated_at'          => $cart->updated_at->toDateTimeString(),
                ];
                break;
            case 'hotel':
                return [
                    'id'                  => (int)$cart->id,
                    'user_id'             => (int)$cart->user_id,
                    'user_name'           => $cart->user ? $cart->user->nickname : '',
                    'amount'              => (int)$cart->amount,
                    'type'                => $cart->type,
                    'product_sku_id'      => (int)$cart->product_sku_id,
                    'product_name'        => $cart->hotelName() . $cart->hotelRoomType(),
                    'product_price'       => (float)$cart->hotelProduct ? $cart->hotelProduct->price : '',
                    'product_image'       => $cart->hotelProductImage()->image,
                    'product_total_money' => $cart->product_total_money,
                    'date'                => json_decode($cart->date, true),
                    'created_at'          => $cart->created_at->toDateTimeString(),
                    'updated_at'          => $cart->updated_at->toDateTimeString(),
                ];
                break;
            case 'ticket':
                return [
                    'id'                  => (int)$cart->id,
                    'user_id'             => (int)$cart->user_id,
                    'user_name'           => $cart->user ? $cart->user->nickname : '',
                    'amount'              => (int)$cart->amount,
                    'type'                => $cart->type,
                    'product_sku_id'      => (int)$cart->product_sku_id,
                    'product_name'        => $cart->attractionName() . $cart->ticketType(),
                    'product_price'       => $cart->ticketProduct ? $cart->ticketProduct->price : '',
                    'product_image'       => $cart->attractionImage(),
                    'product_total_money' => $cart->product_total_money,
                    'date'                => json_decode($cart->date, true),
                    'created_at'          => $cart->created_at->toDateTimeString(),
                    'updated_at'          => $cart->updated_at->toDateTimeString(),
                ];
                break;
        }

    }
}
