<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function getBill()
    {
        if (Auth::check()) {
            $bills = Order::where('user_id', Auth::user()->id)->orderby('created_at', 'DESC')->get();
            $status = OrderStatus::where('id', 5)->orWhere('id', 1)->get();
            return view('client.bill', [
                'bills' => $bills,
                'status' => $status
            ]);
        } else {
            return redirect()->route('index');
        }
    }

    public function getBillCode($code)
    {
        $bill = Order::where('user_id', Auth::user()->id)->where('code', $code)->first();
        $billDetail = OrderProduct::where('order_id', $bill->id)->get();
        $total = 0;
        $options = OptionDetail::all();
        return view('client.bill-detail', [
            'bill' => $bill,
            'billDetail' => $billDetail,
            'total' => $total,
            'options' => $options,
        ]);
    }

    public function changstatus (Request $request) {
        // dd($request->all());
        $data = Order::find($request->id);
        $data->status_id = $request->status;
        $data->save();
        return response()->json($data);
    }
}
