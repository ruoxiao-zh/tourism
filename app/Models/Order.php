<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'no',
        'user_id',
        'username',
        'phone',
        'type',
        'total_amount',
        'remark',
        'order_status',
        'paid_at',
        'payment_no',
        'refund_status',
        'refund_reason',
        'refund_no'
    ];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->no) {
                // 调用 findAvailableNo 生成订单流水号
                $model->no = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->no) {
                    return false;
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        $order_items = OrderItem::where('order_id', $this->id)->get();
        if ($order_items) {
            foreach ($order_items as $key => $item) {
                switch ($item->type) {
                    case 'travel':
                        // 图片
                        $images = TravelLineImage::where('travel_line_id', $item->product_id)->first();
                        ($order_items[$key])->images = $images->image;
                        // 名称
                        $travel = TravelLine::find($item->product_id);
                        ($order_items[$key])->name = $travel->name;
                        // 日期
                        ($order_items[$key])->date = json_decode($item->date, true);
                        break;
                    case 'ticket':
                        // 图片
                        $ticket = Ticket::where('id', $item->product_id)->first();
                        $attraction = Attraction::find($ticket->attraction_id);
                        ($order_items[$key])->images = $attraction->image;
                        // 名称
                        ($order_items[$key])->name = $attraction->name;
                        // 门票类型
                        $ticket_type = TicketType::find($ticket->ticket_type_id);
                        ($order_items[$key])->ticket_type = $ticket_type->name;
                        // 日期
                        ($order_items[$key])->date = json_decode($item->date, true);
                        break;
                    case 'hotel':
                        // 图片
                        $images = HotelRoomImage::where('hotel_room_id', $item->product_id)->first();
                        ($order_items[$key])->images = $images->image;
                        // 名称
                        $hotel_room = HotelRoom::find($item->product_id);
                        $hotel = Hotel::where('id', $hotel_room->hotel_id)->first();
                        $hotel_room_type = HotelRoomType::where('id', $hotel_room->hotel_room_type_id)->first();
                        ($order_items[$key])->name = $hotel->name . $hotel_room_type->type;
                        ($order_items[$key])->hotel_rooms = $hotel_room;
                        // 日期
                        ($order_items[$key])->date = json_decode($item->date, true);
                        break;
                }
            }
        }

        return $order_items;
    }

    /**
     * 生成随机订单编号
     *
     * @return bool|string
     * @throws \Exception
     */
    public static function findAvailableNo()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('no', $no)->exists()) {
                return $no;
            }
        }
        \Log::warning('find order no failed');

        return false;
    }

    /**
     * 生成随机退款订单号
     *
     * @return string
     */
    public static function getAvailableRefundNo()
    {
        do {
            // Uuid类可以用来生成大概率不重复的字符串
            $no = Uuid::uuid4()->getHex();
            // 为了避免重复我们在生成之后在数据库中查询看看是否已经存在相同的退款订单号
        } while (self::query()->where('refund_no', $no)->exists());

        return $no;
    }

    public function orderStatus()
    {
        switch ($this->order_status) {
            case 0:
                return '未支付';
                break;
            case 1:
                return '已支付';
                break;
            case 2:
                return '已发货';
                break;
            case 3:
                return '完成';
                break;
            case 4:
                return '申请退款';
                break;
            case 5:
                return '退款完成';
                break;
        }
    }

    public function refundStatus()
    {
        switch ($this->refund_status) {
            case 'applying':
                return '申请退款';
                break;
            case 'success':
                return '退款完成';
                break;
        }
    }
}
