<?php

namespace App\Services\Orders;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\Carts\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminOrderService
{
    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }
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
            notify()->success('Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    
    public function createTT($request)
    {
        function rand_string($length)
        {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $size = strlen($chars);
            $str = '';
            for ($i = 0; $i < $length; $i++) {
                $str .= $chars[rand(0, $size - 1)];
            }
            return $str;
        }
        try {
            $order = new Order();
            $order->fill($request->all());
            $order->address = 'Canteen BeeFood';
            $order->code = rand_string(12);
            $order->user_id = Auth::user()->id;
            $order->status_id = 5;
            $order->shipper_id = Auth::user()->id;
            $order->voucher = 'thanh toán tại quầy';
            $order->note = 'Mua hàng tại canteen Beefood';
            // dd($order);
            $order->save();
            $count = $this->cartService->getCarttt();
            // dd($count);/
            foreach ($count as $it) {
                $del = Cart::find($it->id);
                $prd = Product::find($del->product_id);
                // dd($prd);
                $data = new OrderProduct();
                $data->order_id = $order->id;
                $data->product_id = $it->product_id;
                $data->nameProduct = $prd->name;
                $data->thumb = $prd->thumb;
                $data->quantity = $del->quantity;
                if ($prd->price_sales == 0 || $prd->price_sales == null) {
                    $data->price = $prd->price;
                    $data->total = $del->quantity * $prd->price;
                } else {
                    $data->price = $prd->price_sales;
                    $data->total = $del->quantity * $prd->price_sales;
                }
                $data->date_order = date(now()->toDateString());
                // dd($data);
                $data->save();
                $del->delete();
            }
            Session()->flash('success', 'Đăt hàng thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Không thể thêm mới sản phẩm');
            Log::info($err->getMessage());
            return false;
        }
    }
}
