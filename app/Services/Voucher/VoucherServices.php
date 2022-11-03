<?php

namespace App\Services\Voucher;

use App\Models\Voucher;
use Illuminate\Support\Facades\Session;

class VoucherServices
{
    public function getAll()
    {
        return Voucher::select('id', 'code', 'thumb', 'description', 'active', 'discount', 'menu_id', 'start_time', 'end_time')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function create($request)
    {
        try {
            Voucher::create([
                'code' => (string) $request->input('code'),
                'description' => (string) $request->input('description'),
                'discount' => (int) $request->input('discount'),
                'thumb' => (string) $request->input('thumb'),
                'active' => (int) $request->input('active'),
                'menu_id' => (int) $request->input('menu_id'),
                'quantity' => (int) $request->input('quantity'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ]);

            notify()->success('Tạo thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $id)
    {
        try {
            $data = Voucher::find($id);
            $data->code = (string) $request->input('code');
            $data->description = (string) $request->input('description');
            $data->discount = (int) $request->input('discount');
            $data->quantity = (int) $request->input('quantity');
            $data->thumb = (string) $request->input('thumb');
            $data->active = (int) $request->input('active');
            $data->menu_id = (int) $request->input('menu_id');
            $data->start_time = $request->input('start_time');
            $data->end_time = $request->input('end_time');
            $data->save();
            notify()->success('Sửa thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function getId($id)
    {
        return Voucher::find($id);
    }

    public function destroyId($id)
    {
        $data = Voucher::find($id);
        $data->delete();
        notify()->success('Xóa thành công');
    }
}
