<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use App\Services\Menu\MenuServices;
use App\Services\Voucher\VoucherServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use Carbon\Carbon;

class VoucherController extends Controller
{

    public function __construct(VoucherServices $voucherServices, MenuServices $menuServices)
    {
        $this->voucherServices = $voucherServices;
        $this->menuServices = $menuServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->status == 200) {
            $vouchers = $this->voucherServices->getVouchers($request)->get();
            return response()->json([
                'vouchers' => $vouchers,
            ]);
        } else {
            $vouchers = $this->voucherServices->getVouchers($request)->paginate(5);
            return view('admin.vouchers.index', [
                'title' => 'Danh sách vouchers',
                'vouchers' => $vouchers
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::today()->timezone('Asia/Ho_Chi_Minh');
        $title = 'Tạo mới voucher';
        $menus = $this->menuServices->getAll();
        return view('admin.vouchers.create', compact('title', 'menus', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherRequest $request)
    {
        if (strtotime($request->start_time) >= strtotime($request->end_time)) {
            notify()->error('Ngày nhập không đúng!');
            return redirect()->route('vouchers.create');
        }
        $this->voucherServices->create($request);
        return redirect()->route('vouchers.index');
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
        $title = 'Cập nhật voucher';
        $voucher = $this->voucherServices->getId($id);
        $menus = $this->menuServices->getAll();
        return view('admin.vouchers.edit', compact('title', 'voucher', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoucherRequest $request, $id)
    {
        $this->voucherServices->update($request, $id);
        return redirect()->route('vouchers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        $voucher->delete();
        return response()->json(['model' => $voucher]);
    }

    public function changeActive(Request $request)
    {
        $voucher = Voucher::find($request->voucher_id);
        if ($request->active == 1) {
            $voucher->active = 0;
            $value = $voucher->active;
            $btnActive = 'bi-unlock-fill';
            $btnRemove = 'bi-lock-fill';
            $color = 'green';
        } else {
            $voucher->active = 1;
            $value = $voucher->active;
            $btnActive = 'bi-lock-fill';
            $btnRemove = 'bi-unlock-fill';
            $color = 'red';
        }
        $voucher->save();
        return response()->json([
            'btnActive' => $btnActive,
            'btnRemove' => $btnRemove,
            'value' => $value,
            'color' => $color,
        ]);
    }
}
