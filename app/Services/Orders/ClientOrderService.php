<?php

namespace App\Services\Orders;

use App\Models\Building;
use App\Models\Cart;
use App\Models\Floor;
use App\Models\Order;
use App\Models\OrderProduct;
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
            foreach ($count as $it) {
                $data = new OrderProduct();
                $data->order_id = $order->id;
                $data->product_id = $it;
                // dd($data->product_id);
                $data->save();
                $del = Cart::find($it);
                $del->delete();
            }
            notify()->success('Đăt hàng thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Không thể thêm mới sản phẩm');
            Log::info($err->getMessage());
            return false;
        }
    }
}
