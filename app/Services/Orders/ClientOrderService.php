<?php

namespace App\Services\Orders;

use App\Models\Building;
use App\Models\Cart;
use App\Models\Floor;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;
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
            if ($request->voucher) {
                $voucher = Voucher::where('code', $request->voucher)->first();
                $userVoucher = new UserVoucher();
                $userVoucher->user_id = Auth::user()->id;
                $userVoucher->voucher_id = $voucher->id;
                $userVoucher->save();
                $voucher->quantity -= 1;
                $voucher->save();
            }
            $building = Building::find($request->building);
            $floor = Floor::find($request->floor);
            $order = new Order();
            $order->fill($request->all());
            $order->address = $building->name . ' - ' . $floor->name . ' - ' . $request->room;
            $order->code = rand_string(12);
            $order->user_id = Auth::user()->id;
            $order->status_id = 1;
            $order->shipper_id = 1;
            $order->voucher = $request->voucher;
            $order->note = $request->note;
            $order->type = 'Mua online';
            $order->save();
            $count = $request->product_id;
            $options = OptionDetail::all();
            foreach ($count as $it) {
                $del = Cart::where('product_id', $it)->where('user_id', Auth::user()->id)->first();
                $prd = Product::find($del->product_id);

                $data = new OrderProduct();
                $data->order_id = $order->id;
                $data->product_id = $it;
                $data->nameProduct = $prd->name;
                $data->thumb = $prd->thumb;
                $data->quantity = $del->quantity;
                $data->options = $del->options;
                if ($prd->price_sales == 0 || $prd->price_sales == null) {
                    if ($del->options != null) {
                        foreach ($del->options as $op) {
                            foreach ($options as $it) {
                                if ($it->id == $op) {
                                    $prd->price += $it->price;
                                }
                            }
                        }
                    }
                    $data->price = $prd->price;
                    $data->total = $del->quantity * $prd->price;
                } else {
                    if ($del->options != null) {
                        foreach ($del->options as $op) {
                            foreach ($options as $it) {
                                if ($it->id == $op) {
                                    $prd->price_sales += $it->price;
                                }
                            }
                        }
                    }
                    $data->price = $prd->price_sales;
                    $data->total = $del->quantity * $prd->price_sales;
                }
                $data->date_order = date(now()->toDateString());
                $data->save();
                $del->delete();
            }
            // Session()->flash('success', 'Đăt hàng thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Không thể thêm mới sản phẩm');
            Log::info($err->getMessage());
            return false;
        }
    }
}
