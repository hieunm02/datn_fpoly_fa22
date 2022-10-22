<?php

namespace App\Services\Carts;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function getCartUser()
    {
        return DB::table('carts')->join('products', 'carts.product_id', '=', 'products.id')->select('products.*', 'carts.id', 'carts.quantity')->where('user_id', '=', Auth::user()->id)->get();
    }
    public function create($request)
    {
        try {
            $cartAllId = DB::table('carts')->where('carts.user_id', '=', Auth::user()->id)->get();
            foreach ($cartAllId as $data) {
                if ($data->product_id == $request->product_id) {
                    $cartId = DB::table('carts')->where('carts.user_id', '=', Auth::user()->id)->where('carts.product_id', '=', $request->product_id)->get();
                    $number = $data->quantity + $request->quantity;
                    // \dd($cartId);
                    $id = $cartId->pluck('id'); // Lấy ra mảng id
                    Session::flash('success', "Thêm vào giỏ hàng thành công!");
                    return Cart::whereIn('id', $id)->update(['quantity' => $number]); // update các post có id trong mảng

                }
            }
            Cart::create($request->all());
            Session::flash('success', "Thêm vào giỏ hàng thành công!");
        } catch (\Exception $err) {
            Session::flash('error', "Vui lòng thử lại");
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function destroyId($id)
    {
    }
}