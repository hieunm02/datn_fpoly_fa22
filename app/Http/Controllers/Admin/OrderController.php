<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;
use App\Services\Carts\CartService;
use App\Services\Menu\MenuServices;
use Illuminate\Http\Request;
use App\Services\Orders\AdminOrderService;
use App\Services\Products\ProductServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    protected $orderService;

    public function __construct(AdminOrderService $orderService, ProductServices $productServices, MenuServices $menuServices, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->productServices = $productServices;
        $this->menuServices = $menuServices;
        $this->cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->status == 200) {
            $orders = $this->orderService->getOrders($request)->get();
            return response()->json([
                'orders' => $orders,
                'arrStatus' => OrderStatus::all(),
            ]);
        } else {
            $orders = $this->orderService->getOrders($request)->paginate(5);
            return view('admin.orders.index', [
                'title' => 'Quản lý đơn hàng',
                'orders' => $orders
            ]);
        }
    }

    public function show(Request $request)
    {
        $order = Order::find($request->id);
        $user = User::find($order->user_id);
        $orderDetails = OrderProduct::where('order_id', $request->id)->get();
        $options = OptionDetail::all();
        return response()->json([
            "order" => $order,
            "user" => $user,
            "options" => $options,
            "orderDetails" => $orderDetails,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $this->orderService->updateStatus($request->status_id, $request->id);

        $order = Order::find($request->id);
        $user = User::find($order->user_id);
        $adminInfor = User::find(1);

        if ($request->status_id == 5) {
            $flag = true;
            $user->point = $user->point + 1;
            $user->save();
        }

        return response()->json([
            'order' => $order,
            'user' => $user,
            'admin' => $adminInfor
        ]);
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
    //thanh toán trực tiếp
    public function payment()
    {
        $prds = Product::all();
        $cartOrder = DB::table('carts')->select('order_tt')->where('user_id', '=', '')->groupBy('order_tt')->orderBy('order_tt', 'DESC')->get();
        // dd($cartOrder);
        $menus = $this->menuServices->getMenuIndex();
        return view('admin.thanh-toan-truc-tiep.index', [
            'title' => 'Thanh toán trực tuyến',
            'prds' => $prds,
            'menus' => $menus,
            'cartOrder' => $cartOrder,
        ]);
    }
    //show cart tt
    public function getCart(Request $request)
    {
        $cart = $this->cartService->getCarttt($request->order_tt);
        $cartOrder = DB::table('carts')->select('order_tt')->where('user_id', '=', '')->groupBy('order_tt')->orderBy('order_tt', 'DESC')->get();
        $btn_order  = '';
        foreach ($cartOrder as $index => $it) {
            $index += 1;

            $btn_order .= "<div class='position-relative d-inline-block' style='margin: 0px 2px;'>
                                <div class='btn btn-success py-1 px-2' data-id='$it->order_tt'
                                    onclick='showDonHang($it->order_tt)'>Đơn $index
                                </div>
                                <div class='position-absolute bg-danger d-flex justify-content-center align-items-center icon-close-order' data-id='$it->order_tt'><i class='fas fa-times'></i></div>
                            </div>";
        }
        $btn_order .= "<div class='btn btn-success mr-1 p-1' onclick='createOrderNew()'><i class='bi bi-plus'></i></div>";
        $data = '';
        $order_tt = '';
        $totals = 0;
        foreach ($cart as $el) {
            if ($el->price_sales == 0 || $el->price_sales == Null) {
                $total = $el->price * $el->quantity;
            } else {
                $total = $el->price_sales * $el->quantity;
            }
            $totalPrd = number_format($total);
            $data .= "<tr>
                <td>$el->name</td>
                <td class='d-flex align-items-center'><input style='width: 40px; background: wheat;' min='1' class='p-1 qty$el->id' type='number' name='quantity' value='$el->quantity'><button class='outline-none btn-success py-1 px-2 border border-1' onclick='updateQtyTT($el->id)'><i class='bi bi-check'></i></button></td>
                <td>$totalPrd<sup>đ</sup></td>
                <td>
                    <a onclick='deleteTT($el->id)' class='deleteTT' data-id='$el->id'>
                        <i class='bi bi-trash text-danger'></i>
                    </a>
                </td>
            </tr>";
            $totals += $total;
            $order_tt = $el->order_tt;
        }
        return response()->json([
            'total' => $totals,
            'data' => $data,
            'order_tt' => $order_tt,
            'btn_order' => $btn_order
        ], 200);
    }
    //thêm cart tt
    public function directPayment(Request $request)
    {
        $cart = Cart::where('user_id', '=', '')->where('order_tt', '=', $request->order_tt)->get();
        // dd($cart);
        $check = 0;
        foreach ($request->value as $el) {
            foreach ($cart as $it) {
                if ($it->product_id == $el) {
                    $update = Cart::find($it->id);
                    $update->quantity += 1;
                    $update->save();
                    $check = 1;
                }
            }
            if ($check == 0) {
                $data = new Cart();
                $data->product_id = $el;
                $data->user_id = '';
                $data->quantity = 1;
                $data->order_tt = $request->order_tt;
                $data->date = Carbon::now()->toDateString();
                $data->save();
            }
            $check = 0;
        }
        return response()->json();
    }
    //thanh toán
    public function pay(Request $request)
    {
        $cart = $this->cartService->getCarttt($request->order_tt);
        if (count($cart) > 0) {
            $data = $this->orderService->createTT($request);
            return response()->json($data);
        } else {
            $data = "Không có sản phẩm trong giỏ!";
            return response()->json($data, 500);
        }
    }
    // xóa đơn hàng chưa thanh toán trong trang thanh toán trực tiếp
    public function deleteCartOrder($order_tt)
    {
        $data = Cart::where('order_tt', '=', $order_tt)->get();
        foreach ($data as $it) {
            $del = Cart::find($it->id);
            $del->delete();
        }
        return response()->json($data);
    }

    public function getOrderDetails(Request $request, $id)
    {
        $data = OrderProduct::where('order_id', $id)->get();
        $options = OptionDetail::all();
        $result = [$data, $options];

        return response()->json($result);
    }
}
