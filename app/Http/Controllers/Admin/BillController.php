<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Danh sách đơn hàng';
        $bills = Order::where('status_id', 4)->orderBy('updated_at','DESC')->paginate(5);
        return view('admin.bills.index', compact('bills', 'title'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $bill = Order::find($request->id);
        $user = User::find($bill->user_id);
        $billDetail = OrderProduct::with('product')->where('order_id', '=', $request->id)->get();
        $options = OptionDetail::all();
        $voucher = Voucher::where('code', $bill->voucher)->first();
        return response()->json([
            'bill' => $bill,
            'billDetail' => $billDetail,
            'user' => $user,
            'options' => $options,
            'voucher' => $voucher,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
}
