<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Orders\AdminOrderService;

class OrderController extends Controller
{

    protected $orderService;

    public function __construct(AdminOrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        // $cancelled = $this->orderService->getOrderByStatus(5);
        $title = "Quản lý đơn hàng";

        return view('admin.orders.index', compact('title', 'orders'));
    }

    public function updateStatus($status_id, $id)
    {
        $this->orderService->updateStatus($status_id, $id);
    }
}
