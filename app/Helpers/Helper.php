<?php

namespace App\Helpers;

use App\Models\Notify;
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
                $StatusStr .= '<option class="status-' . $order->id . '" value="' . $stt->id . '"
                        ' . $stt->id == $order->status_id ? ' selected' : '' . '>
                        ' . $stt->name . '</option>';
            }
        }

        return $StatusStr;
    }

    public static function notifies()
    {
        $result = '';
        $string = '';
        $notifies = Notify::select('id', 'user_id', 'role', 'status', 'type', 'created_at')->orderBy('created_at', 'DESC')->limit(5)->get();
        foreach ($notifies as $notify) {
            if ($notify->type == 'order') {
                $string .= ' <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom notify notify-pending">
                                <div class="d-flex">
                                    <div class="avatar avatar-cyan avatar-icon">
                                        <i class="anticon anticon-shopping-cart"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-dark font-weight-semibold">Đơn hàng mới từ ' . $notify->user->name . '</p>
                                        <p class="m-b-0"><small>' . $notify->created_at->diffForHumans() . '</small></p>
                                    </div>
                                </div>
                            </a>';
            } elseif ($notify->type == 'comment') {
                $string .= '<a href="/products/' . $notify->product_id . '/product-detail#divCmt' . $notify->comment_id . '" class="dropdown-item d-block p-15 border-bottom notify notify-pending">
                                <div class="d-flex">
                                    <div class="avatar avatar-gold avatar-icon">
                                        <i class="anticon anticon-message"></i>
                                    </div>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-dark font-weight-semibold">' . $notify->user->name . ' đã bình luận</p>
                                        <p class="m-b-0"><small>' . $notify->created_at->diffForHumans() . '</small></p>
                                    </div>
                                </div>
                            </a>';
            } else {
                $string .= '<a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom notify notify-pending">
                <div class="d-flex">
                    <div class="avatar avatar-blue avatar-icon">
                        <i class="anticon anticon-mail"></i>
                    </div>
                    <div class="m-l-15">
                        <p class="m-b-0 text-dark font-weight-semibold">Liên hệ từ"' . $notify->user->name . '</p>
                        <p class="m-b-0"><small>' . $notify->created_at->diffForHumans() . '</small></p>
                    </div>
                </div>
            </a>';
            }
        }
        $result .= $string;
        return $result;
    }
}
