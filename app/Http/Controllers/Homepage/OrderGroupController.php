<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\OrderGroup;
use App\Models\Product;
use App\Services\Ordergroup\OrderGroupServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class OrderGroupController extends Controller
{
    protected $orderGroupService;
    public function __construct(OrderGroupServices $orderGroupService)
    {
        $this->orderGroupService = $orderGroupService;
    }

    public function getProducts()
    {
        $carts = DB::table('order_group')
        ->join('users', 'order_group.user_id', '=', 'users.id')
        ->join('products', 'order_group.product_id', '=', 'products.id')
        ->select('order_group.room as room', 'order_group.role as role', 'order_group.quantity as quantity', 'users.id as user_id', 'users.name as user_name', 'users.avatar as user_avatar',
        'products.id as product_id', 'products.name as product_name', 'products.price as product_price')
        ->where('order_group.room', URL::full())
        ->distinct()
        ->get();

        $listMembers = DB::table('order_group')
        ->join('users', 'order_group.user_id', '=', 'users.id')
        ->distinct()
        ->select('order_group.room as room', 'order_group.role as role', 'users.id as user_id', 'users.name as user_name', 'users.avatar as user_avatar')
        ->get();

        $products = $this->orderGroupService->getAll();
        return view('client.order-group', [
            'title' => 'Đặt hàng nhóm',
            'products' => $products,
            'carts' => $carts,
            'listMembers' => $listMembers,
        ]);
    }

    public function quickview(Request $request)
    {
        // tìm xem sản phẩm này đã có trong giỏ hàng hay chưa 
        $cart_product = OrderGroup::where('product_id', $request->product_id)->where('room', $request->room)->where('user_id', Auth::user()->id)->first();
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        
        $output['product_id'] = $product->id;
        $output['product_name'] = $product->name;
        $output['product_price'] = $product->price;
        $output['product_thumb'] = $product->thumb;

        if($cart_product){
            $output['cart_product'] = true;
            $output['cart_product_quantity'] = $cart_product->quantity;
        }else{
            $output['cart_product'] = false;
            $output['cart_product_quantity'] = $request->quantity;
        }
        echo json_encode($output);
    }

    public function createGroup(Request $request)
    {
        OrderGroup::create([
            'room' => $request->room,
            'user_id' => $request->user_id,
            'role' => $request->role,
        ]);
    }

    public function addToCart(Request $request)
    {
        $product = OrderGroup::where('product_id', $request->product_id)->where('room', $request->room)->where('user_id', $request->user_id)->first();
        if($product){
            $quantity = $product->quantity + $request->quantity;
            $product->update([
                'quantity' => $quantity,
            ]);
        }else{
            OrderGroup::create([
                'room' => $request->room,
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }
    }


}
