<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;

class Helper
{
    public static function active($active = 1): string
    {
        return $active == 1 ? '<span class="btn btn-danger btn-xs">No</span>' : '<span class="btn btn-success btn-xs">Yes</span>';
    }

    public static function auth($code)
    {
        $orders = Order::where('code', 'LIKE', '%' . $code . '%')->get();
        $authors = User::all();
        foreach ($orders as $order) {
            foreach ($authors as $author) {
                if ($author->id == $order->user_id) {
                    $authStr = '<td> ' . $author->name . ' </td>';
                }
            }
        }
        return $authStr;
    }

    public static function status($code)
    {
        $orders = Order::where('code', 'LIKE', '%' . $code . '%')->get();
        $status = OrderStatus::all();
        $StatusStr = '';
        foreach ($orders as $order) {
            foreach ($status as $stt) {
                $StatusStr .= '<option class="status-'. $order->id .'" value="'. $stt->id .'"
                        '. $stt->id == $order->status_id ? ' selected' : '' .'>
                        '. $stt->name .'</option>';
            }
        }

        return $StatusStr;
    }
}
