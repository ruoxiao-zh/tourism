<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = ['user_id', 'amount', 'type', 'product_sku_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // 旅游
    public function travelProduct()
    {
        return $this->belongsTo(TravelLine::class, 'product_sku_id', 'id');
    }

    // 旅游图片
    public function travelProductImage()
    {
        return TravelLineImage::where('travel_line_id', $this->product_sku_id)->first();
    }

    // 酒店名称
    public function hotelName()
    {
        $hotel_room = HotelRoom::where('id', $this->product_sku_id)->first();
        if ($hotel_room) {
            $hotel = Hotel::where('id', $hotel_room->hotel_id)->first();
            if ($hotel) {
                return $hotel->name;
            }
            return;
        }
        return;
    }

    // 房间类型
    public function hotelRoomType()
    {
        $hotel_room = HotelRoom::where('id', $this->product_sku_id)->first();
        if ($hotel_room) {
            $hotel_room_type = HotelRoomType::where('id', $hotel_room->hotel_room_type_id)->first();
            if ($hotel_room_type) {
                return $hotel_room_type->type;
            }
            return;
        }
        return;
    }

    // 房间
    public function hotelProduct()
    {
        return $this->belongsTo(HotelRoom::class, 'product_sku_id', 'id');
    }

    // 房间图片
    public function hotelProductImage()
    {
        return HotelRoomImage::where('hotel_room_id', $this->product_sku_id)->first();
    }

    // 门票
    public function ticketProduct()
    {
        return $this->belongsTo(Ticket::class, 'product_sku_id', 'id');
    }

    // 景区名称
    public function attractionName()
    {
        $ticket = Ticket::where('id', $this->product_sku_id)->first();
        if ($ticket) {
            $attraction = Attraction::find($ticket->attraction_id);
            if ($attraction) {
                return $attraction->name;
            }
            return;
        }
        return;
    }

    // 景区图片
    public function attractionImage()
    {
        $ticket = Ticket::where('id', $this->product_sku_id)->first();
        if ($ticket) {
            $attraction = Attraction::find($ticket->attraction_id);
            if ($attraction) {
                return $attraction->image;
            }
            return;
        }
        return;
    }

    // 门票类型
    public function ticketType()
    {
        $ticket = Ticket::where('id', $this->product_sku_id)->first();
        if ($ticket) {
            $ticket_type = TicketType::find($ticket->ticket_type_id);
            if ($ticket_type) {
                return $ticket_type->name;
            }
            return;
        }
        return;
    }
}
