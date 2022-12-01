<?php

namespace App\Services\Orders;

use App\Models\Building;
use App\Models\Cart;
use App\Models\Floor;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ClientOrderService
{

    public function create($request)
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
            $building = Building::find($request->building);
            $floor = Floor::find($request->floor);
            $order = new Order();
            $order->fill($request->all());
            $order->address = $building->name . ' - ' . $floor->name . ' - ' . $request->room;
            $order->code = rand_string(12);
            $order->user_id = Auth::user()->id;
            $order->status_id = 1;
            $order->shipper_id = 1;
            $order->voucher = 'voucher';
            $order->note = $request->note;
            // dd($order);
            $order->save();
            $count = $request->product_id;
            dd($count);
            foreach ($count as $it) {
                $del = Cart::find($it);
                $prd = Product::find($del->product_id);
                // dd($prd);
                $data = new OrderProduct();
                $data->order_id = $order->id;
                $data->product_id = $it;
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
                $data->price = $prd->price;
                $data->total = $del->quantity * $prd->price;
                if ($del->quantity * $prd->price);
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
