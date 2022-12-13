<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Order;
use App\Models\OrderGroup;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use App\Services\Carts\CartService;
use App\Services\Ordergroup\OrderGroupServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class OrderGroupController extends Controller
{
    protected $orderGroupService;
    protected $cartService;
    public function __construct(OrderGroupServices $orderGroupService, CartService $CartServices)
    {
        $this->orderGroupService = $orderGroupService;
        $this->CartServices = $CartServices;
    }

    public function getProducts()
    {
        $carts = DB::table('order_group')
        ->join('users', 'order_group.user_id', '=', 'users.id')
        ->join('products', 'order_group.product_id', '=', 'products.id')
        ->select('order_group.id as id', 'order_group.room as room', 'order_group.role as role', 'order_group.quantity as quantity', 'users.id as user_id', 'users.name as user_name', 'users.avatar as user_avatar',
        'products.id as product_id', 'products.name as product_name', 'products.price as product_price')
        ->where('order_group.room', URL::full())
        ->where('order_group.quantity', '>', 0)
        ->distinct()
        ->get();

        $listMembers = DB::table('order_group')
        ->join('users', 'order_group.user_id', '=', 'users.id')
        ->select('order_group.room as room', 'order_group.role as role', 'users.id as user_id', 'users.name as user_name', 'users.avatar as user_avatar')
        ->where('order_group.room', URL::full())
        ->where('order_group.role', '!=', null)
        ->distinct()
        ->get();

        $products = $this->orderGroupService->getAll();

        $buildings = $this->CartServices->getBuilding();
        return view('client.order-group', [
            'title' => 'Đặt hàng nhóm',
            'products' => $products,
            'carts' => $carts,
            'listMembers' => $listMembers,
            'buildings' => $buildings,
        ]);
    }

    public function checkOut(Request $request)
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
            return redirect()->back();
        } catch (\Exception $err) {
            Session::flash('error', 'Không thể thêm mới sản phẩm');
            Log::info($err->getMessage());
            return false;
        }
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
        $output['product_thumb'] = '<img src="http://localhost:8000/'.$product->thumb.'" alt="" width="100%">';

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
            ]);
        }
    }

    public function listMember(Request $request)
    {
        $listMembers = DB::table('order_group')
        ->where('room', $request->room)
        ->join('users', 'order_group.user_id', 'users.id')
        ->select('users.name as user_name', 'users.avatar as user_avatar')
        ->get();

        echo json_encode($listMembers);

    }

    public function listProductCart(Request $request)
    {
        $carts = DB::table('order_group')
            ->join('products', 'order_group.product_id', '=', 'products.id')
            ->join('users', 'order_group.user_id', '=', 'users.id')
            ->select('order_group.id as id', 'order_group.room as room', 'order_group.quantity as quantity', 'users.id as user_id',
                'products.id as product_id', 'products.name as product_name', 'products.price as product_price')
            ->where('order_group.room', $request->room)
            ->where('order_group.quantity', '>', 0)
            ->get();

        echo json_encode($carts);
    }

    public function vnpay_banking(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/carts/";
        $vnp_TmnCode = "6TN9ZIRH";
        $vnp_HashSecret = "CXNUVHGJEAPHVUTYTVMZJNMPDWXVTZGP";
        $data = $request->all();
        $vnp_TxnRef = rand(00, 9999);
        $vnp_OrderInfo = 'Thanh Toán Đơn Hàng';
        $vnp_OrderType = 'billpayment' ;
        $vnp_Amount = $data['total'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
