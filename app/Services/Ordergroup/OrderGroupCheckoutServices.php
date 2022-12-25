<?php

namespace App\Services\Ordergroup;


use App\Models\Building;
use App\Models\Cart;
use App\Models\Floor;
use App\Models\Order;
use App\Models\OrderGroup;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrderGroupCheckoutServices
{
    public function getBuilding()
    {
        return Building::with('floors', 'rooms')->get();
    }
    
    public function getCarts($room)
    {
        return DB::table('order_group')
        ->join('users', 'order_group.user_id', '=', 'users.id')
        ->join('products', 'order_group.product_id', '=', 'products.id')
        ->select('order_group.id as id', 'order_group.options as options', 'order_group.room as room', 'order_group.role as role', 'order_group.quantity as quantity', 'users.id as user_id', 'users.name as user_name', 'users.avatar as user_avatar',
        'products.id as product_id', 'products.name as product_name', 'products.price as product_price')
        ->where('order_group.room', $room)
        ->where('order_group.quantity', '>', 0)
        ->distinct()
        ->get();
    }
   
    public function checkOut($request)
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
            $order->voucher = $request->voucher_code;
            $order->type = 'Mua online';
            $order->note = $request->note;
            $order->save();
            $count = $request->product_id;
            foreach ($count as $it) {
                $del = OrderGroup::find($it);
                $prd = Product::find($del->product_id);
                $user_name = User::find($del->user_id);
                $data = new OrderProduct();
                $data->order_id = $order->id;
                $data->product_id = $it;
                $data->user_name = $user_name->name;
                $data->nameProduct = $prd->name;
                $data->thumb = $prd->thumb;
                $data->quantity = $del->quantity;
                // $data->options = $del->options;
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
            Session::flash('success', 'Đăt hàng thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Không thể thêm mới sản phẩm');
            Log::info($err->getMessage());
            return false;
        }
    }
}
