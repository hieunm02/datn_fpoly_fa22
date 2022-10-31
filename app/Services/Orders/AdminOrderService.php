<?php

namespace App\Services\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Session;

class AdminOrderService
{

    public function getAll()
    {
        return Order::with('status')->paginate(5);
    }

    public function getAllOrders()
    {
        return Order::all();
    }

    public function getOrderExcept($status_id)
    {
        return Order::where("status_id", "<>", $status_id)->get();
    }

    public function getOrderByStatus($status_id)
    {
        return Order::where("status_id", "=", $status_id)->get();
    }

    public function updateStatus($status_id, $id)
    {
        try {
            $ordersModel = Order::find($id);
            $ordersModel->status_id = $status_id;
            $ordersModel->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }
}
