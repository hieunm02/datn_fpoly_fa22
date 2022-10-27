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

    public function getByStatusId($status_id)
    {
        return Order::where('status_id', '=', $status_id)->get();
    }
}
