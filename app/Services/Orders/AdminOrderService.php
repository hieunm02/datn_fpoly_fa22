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
}