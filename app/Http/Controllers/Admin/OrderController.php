<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Orders\AdminOrderService;
use Illuminate\Support\Facades\Auth;

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

    public function updateStatus(Request $request)
    {
        $order = $this->orderService->updateStatus($request->status_id, $request->id);

        $user = User::find(Auth::id());
        $flag = false;

        if ($request->status_id == 5) {
            $flag = true;
            $user->point = $user->point + 1;
            $user->save();
        }

        return response()->json(['order' => $order]);
    }

    public function searchByCode(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::where('code', 'LIKE', '%' . $request->code . '%')->get();
            if ($orders  != null) {
                $result = '';
                foreach ($orders as $order) {
                    $result .= '<tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-order-' . $order->id . '" type="checkbox">
                                            <label for="check-order-' . $order->id . '" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>#' . $order->id . '</td>
                                    <td>' . $order->code . '</td>
                                    <td>' . $order->name . '</td>
                                    <td>' . $order->phone . '</td>
                                    <td>' . $order->address . '</td>
                                    <td>' . $order->created_at . '</td> ' .
                        \App\Helpers\Helper::auth($request->code)
                        . '<td>' . $order->note . '</td>
                                    <td>
                                        <select name="status" id="status" class="custom-select"
                                            style="min-width: 180px;" onchange="changeStatusAjax(' . $order->id . ')">
                                            ' . \App\Helpers\Helper::status($request->code) . '
                                        </select>
                                    </td>
                                </tr>';
                }
                return response()->json(['result' => $result], 200);
            } else {
                $error = 'Không có bản ghi nào!';
                return response()->json(['error' => $error], 404);
            }
        }
    }

    public function searchByStatus(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::where('status_id', $request->status_id)->get();
            if ($orders  != null) {
                $result = '';
                foreach ($orders as $order) {
                    $result .= '<tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-order-' . $order->id . '" type="checkbox">
                                            <label for="check-order-' . $order->id . '" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>#' . $order->id . '</td>
                                    <td>' . $order->code . '</td>
                                    <td>' . $order->name . '</td>
                                    <td>' . $order->phone . '</td>
                                    <td>' . $order->address . '</td>
                                    <td>' . $order->created_at . '</td> ' .
                        \App\Helpers\Helper::auth($request->code)
                        . '<td>' . $order->note . '</td>
                                    <td>
                                        <select name="status" id="status" class="custom-select"
                                            style="min-width: 180px;" onchange="changeStatusAjax(' . $order->id . ')">
                                            ' . \App\Helpers\Helper::status($request->code) . '
                                        </select>
                                    </td>
                                </tr>';
                }
                return response()->json(['result' => $result], 200);
            }
        }
    }
}
