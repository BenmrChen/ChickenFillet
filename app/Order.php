<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public static function createOrder($item) {
        $order = new Order();
        $order->name = $item['order_name'];
        $order->user_id = $item['user_id'];
        $order->shop_name = $item['shop_name'];
        $order->item_name = $item['product_name'];
        $order->item_description = isset($item['description']) ? $item['description'] : '';
        $order->unit_price = $item['price'];
        $order->quantity = $item['qty'];
        $order->total_amount = $item['price'] * $item['qty'];
        $order->merchant_trade_no = $item['merchant_trade_no'];
        $order->save();
        return $order;
    }

    public static function updateOrderStatus($merchant_trade_no) {
        $order = Order::where('merchant_trade_no', $merchant_trade_no)->update(['status' => 1]);
        return $order;
    }
}
