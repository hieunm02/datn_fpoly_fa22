<?php

namespace App\Services\Ordergroup;

use App\Models\Building;
use App\Models\Floor;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\OrderGroup;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class OrderGroupServices
{
    public function getAll()
    {
        return  Product::with('menu')
            ->select('id', 'name', 'menu_id', 'price', 'price_sales', 'quantity', 'thumb', 'active')
            ->orderBy('id', 'DESC')->get();
    }

    public function getCarts()
    {
        return DB::table('order_group')
        ->join('users', 'order_group.user_id', '=', 'users.id')
        ->join('products', 'order_group.product_id', '=', 'products.id')
        ->select('order_group.id as id', 'order_group.room as room', 'order_group.role as role', 'order_group.quantity as quantity', 'users.id as user_id', 'users.name as user_name', 'users.avatar as user_avatar',
        'products.id as product_id', 'products.name as product_name', 'products.price as product_price')
        ->where('order_group.room', URL::full())
        ->where('order_group.quantity', '>', 0)
        ->distinct()
        ->get();
    }

    public function getListMembers()
    {
        return DB::table('order_group')
        ->join('users', 'order_group.user_id', '=', 'users.id')
        ->select('order_group.room as room', 'order_group.role as role', 'users.id as user_id', 'users.name as user_name', 'users.avatar as user_avatar')
        ->where('order_group.room', URL::full())
        ->where('order_group.role', '!=', null)
        ->distinct()
        ->get();
    }

    public function quickView($request)
    {
        $cart_product = OrderGroup::where('product_id', $request->product_id)->where('room', $request->room)->where('user_id', Auth::user()->id)->first();
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $product_option_details = DB::table('product_option_details')
        ->where('product_id', $product_id)->where('active', 0)
        ->join('option_details', 'product_option_details.option_detail_id', '=', 'option_details.id')
        ->select('product_option_details.*', 'option_details.value', 'option_details.price')
        ->get();

        $output['product_id'] = $product->id;
        $output['product_name'] = $product->name;
        $output['product_price'] = $product->price;
        $output['product_thumb'] = '<img src="http://localhost:8000/'.$product->thumb.'" alt="" width="100%">';
        $output['product_option'] = $product_option_details;
        
        if($cart_product){
            $output['cart_product'] = true;
            $output['cart_product_quantity'] = $cart_product->quantity;
        }else{
            $output['cart_product'] = false;
            $output['cart_product_quantity'] = $request->quantity;
        }
        echo json_encode($output);
    }

    public function createGroup($request)
    {
        return OrderGroup::create([
            'room' => $request->room,
            'user_id' => $request->user_id,
            'role' => $request->role,
        ]);
    }

    public function addToCart($request)
    {
        $product = OrderGroup::where('product_id', $request->product_id)->where('room', $request->room)->where('user_id', $request->user_id)->first();
        if($product){
            $quantity = $product->quantity + $request->quantity;
            if($quantity < 1){
                $product->delete();
            }else{
            $product->update([
                'quantity' => $quantity,
            ]);}
        }else{
            OrderGroup::create([
                'room' => $request->room,
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'options' =>  explode(',',$request->options),
            ]);
        }
    }

    public function listMember($request)
    {
        $listMembers = DB::table('order_group')
        ->where('room', $request->room)
        ->join('users', 'order_group.user_id', 'users.id')
        ->select('users.name as user_name', 'users.avatar as user_avatar')
        ->distinct()
        ->get();

        echo json_encode($listMembers);
    }
}