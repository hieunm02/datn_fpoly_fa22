<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Building;
use App\Models\Cart;
use App\Models\Floor;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\UserVoucher;
use App\Models\Voucher;
use App\Services\Orders\ClientOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    protected $orderService;

    public function __construct(ClientOrderService $orderService)
    {
        $this->orderService = $orderService;
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
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        // dd($request->all());
        $this->orderService->create($request);
        $data = Cart::where('order_tt', '=', null)->where('user_id', '=', Auth::user()->id)->get();
        return response()->json([
            'count' => count($data),
            'prd' => $request->product_id,
        ]);
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //cổng thanh toán vnpay
    public function vnpay_payment(OrderRequest $request)
    {
        session(['url_prev' => url()->previous()]);
        $count_sp = $request->product_id;

        $optionss = OptionDetail::all();
        $total_pay = 0;
        foreach ($count_sp as $it) {
            $del = Cart::where('product_id', $it)->where('user_id', Auth::user()->id)->first();
            $prd = Product::find($del->product_id);
            if ($prd->price_sales == 0 || $prd->price_sales == null) {
                if ($del->options != null) {
                    foreach ($del->options as $op) {
                        foreach ($optionss as $it) {
                            if ($it->id == $op) {
                                $prd->price += $it->price;
                            }
                        }
                    }
                }
                $total_pay += $del->quantity * $prd->price;
            } else {
                if ($del->options != null) {
                    foreach ($del->options as $op) {
                        foreach ($optionss as $it) {
                            if ($it->id == $op) {
                                $prd->price_sales += $it->price;
                            }
                        }
                    }
                }
                $total_pay += $del->quantity * $prd->price_sales;
            }
        }
        $inputDataOrder = $request->all();
        // dd($inputDataOrder);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('return_vnpay_payment', $inputDataOrder);
        $vnp_TmnCode = "9RST9CUF"; //Mã website tại VNPAY 
        $vnp_HashSecret = "FBRMBZBITJAFDLSHMNQPERTDDCJSYPKL"; //Chuỗi bí mật

        $vnp_TxnRef = rand_string(12); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán VnPay';
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
    public function return_vnpay(Request $request)
    {
        // $url = session('url_prev', '/');
        if ($request->vnp_ResponseCode == "00") {
            if ($request->voucher_user) {
                $voucher = Voucher::where('code', $request->voucher_user)->first();
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
            $order->code = $request->vnp_TxnRef;
            $order->user_id = Auth::user()->id;
            $order->status_id = 1;
            $order->shipper_id = 1;
            $order->voucher = $request->voucher_user;
            $order->note = $request->note;
            $order->type = 'Vnpay';
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
            return redirect()->route('carts.index');
        }
        return redirect()->route('carts.index');
    }
}
