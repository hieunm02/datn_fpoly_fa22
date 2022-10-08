<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Services\Menu\MenuServices;
use App\Services\Voucher\VoucherServices;
use Illuminate\Http\Request;

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
    public function index()
    {
        $title = 'Danh sách vouchers';
        $vouchers = $this->voucherServices->getAll();
        return view('admin.vouchers.index', compact('title', 'vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo mới voucher';
        $menus = $this->menuServices->getAll();
        return view('admin.vouchers.create', compact('title', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    public function update(Request $request, $id)
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
        return response()->json(['voucher' => $voucher]);
    }
}
