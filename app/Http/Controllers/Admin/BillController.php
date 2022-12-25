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
    public function index(Request $request)
    {
        try {
            $title = 'Danh sách hóa đơn';
            $txt_search = $request->get('txt_search');

            $bills = Order::where('status_id', 4)
                ->where('code', 'like', '%' . $txt_search . '%')
                ->orderBy('updated_at', 'DESC')
                ->paginate(5)->withQueryString();
            return view('admin.bills.index', compact('bills', 'title', 'txt_search'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
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
    public function show($id)
    {
        $title = 'Hóa đơn chi tiết';
        $bill = Order::where('id', $id)->first();
        $voucher = Voucher::where('code', $bill->voucher)->first();
        $billDetail = OrderProduct::where('order_id', $bill->id)->get();
        $total = 0;
        $options = OptionDetail::all();
        return view('admin.bills.bill-detail', [
            'bill' => $bill,
            'title' => $title,
            'billDetail' => $billDetail,
            'total' => $total,
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
