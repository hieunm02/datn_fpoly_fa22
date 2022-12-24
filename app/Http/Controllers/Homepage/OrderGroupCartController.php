<?php


namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderGroupRequest;
use App\Models\Building;
use App\Models\Cart;
use App\Models\Floor;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\OrderGroup;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Room;
use App\Models\User;
use App\Models\Voucher;
use App\Services\Carts\CartService;
use App\Services\Ordergroup\OrderGroupCheckoutServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class OrderGroupCartController extends Controller
{
    public function __construct(OrderGroupCheckoutServices $OrderGroupCheckout)
    {
        $this->OrderGroupCheckout = $OrderGroupCheckout;
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            $room = $request->room;
            //danh sách sản phẩm trong giỏ hàng
            $carts = $this->OrderGroupCheckout->getCarts($room);
            //danh sách thành viên trong nhóm
            $buildings = $this->OrderGroupCheckout->getBuilding();
            $total = 0;
            // $options = OptionDetail::all();
            $vouchers = Voucher::all();
            return view('client.order-group-checkout', compact('carts', 'total', 'buildings', 'vouchers'));
        } else {
            Session::flash('error', 'Bạn chưa đăng nhập');
            return redirect('/');
        }
    }

    public function getFloor(Request $request)
    {
        $id = $request->id;
        $floor = Floor::where('building_id', $id)->get();
        return response()->json($floor, 200);
    }
    public function getRoom(Request $request)
    {
        $floor_id = $request->floor_id;
        // $building_id = $request->building_id;->where('building_id', $building_id)
        $room = Room::where('floor_id', $floor_id)->get();
        return response()->json($room, 200);
    }

    public function checkOut(OrderGroupRequest $request)
    {
        $this->OrderGroupCheckout->checkOut($request);
        return redirect('/bills');
    }

    public function vnpay_payment_group(OrderGroupRequest $request)
    {
        $data = $request->all();
        array_shift($data);
        // dd($data);
        session(['url_prev' => url()->previous()]);
        $count_sp = $request->product_id;
        $total_pay = 0;
        // $voucher = Voucher::where('code', $request->voucher_user)->first();
        foreach ($count_sp as $it) {
            $del = OrderGroup::find($it);
            $prd = Product::find($del->product_id);
            if ($prd->price_sales == 0 || $prd->price_sales == null) {
                $total_pay += $del->quantity * $prd->price;
            } else {
                $total_pay += $del->quantity * $prd->price_sales;
            }
        }
        // dd($total_pay);
        // $total_pay = $total_pay * (100 - $voucher->discount) / 100;
        $inputDataOrder = $data;
        // dd($inputDataOrder);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('return_vnpay_payment_group', $inputDataOrder);
        // dd($vnp_Returnurl);
        $vnp_TmnCode = "9RST9CUF"; //Mã website tại VNPAY 
        $vnp_HashSecret = "FBRMBZBITJAFDLSHMNQPERTDDCJSYPKL"; //Chuỗi bí mật

        $vnp_TxnRef = rand_string(12); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán VnPay';
        // dd($vnp_TxnRef);
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int)$total_pay * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
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
            "vnp_TxnRef" => $vnp_TxnRef,
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    //cho đơn vào order 
    public function return_vnpay_group(Request $request)
    {
        // $url = session('url_prev', '/');
        if ($request->vnp_ResponseCode == "00") {
            // if ($request->voucher_user) {
            //     $voucher = Voucher::where('code', $request->voucher_user)->first();
            //     $userVoucher = new UserVoucher();
            //     $userVoucher->user_id = Auth::user()->id;
            //     $userVoucher->voucher_id = $voucher->id;
            //     $userVoucher->save();
            //     $voucher->quantity -= 1;
            //     $voucher->save();
            // }
            $building = Building::find($request->building);
            $floor = Floor::find($request->floor);
            $order = new Order();
            $order->fill($request->all());
            $order->address = $building->name . ' - ' . $floor->name . ' - ' . $request->room;
            $order->code = rand_string(12);
            $order->user_id = Auth::user()->id;
            $order->status_id = 1;
            $order->shipper_id = 1;
            // $order->voucher = $request->voucher_code;
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
            return redirect()->route('bills');
        }
        return redirect()->route('bills');
    }
}
