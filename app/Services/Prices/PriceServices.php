<?php

namespace App\Services\Prices;

use App\Models\Price;
use Illuminate\Support\Facades\Session;

class PriceServices
{
    public function getAll()
    {
        return Price::select('id', 'original', 'sale')
            ->orderByDesc('id')->paginate(5);
    }

    public function getPrice()
    {
        return Price::get();
    }

    public function create($request)
    {
        try {
            Price::create([
                'original' => (float) $request->input('original'),
                'sale' => (float) $request->input('sale'),
            ]);
            Session::flash('success', 'Tạo mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

   
    public function update($request, $id){
        try {
            $data = Price::find($id);
            $data->update([
                'original' => (float) $request->input('original'),
                'sale' => (float) $request->input('sale'),
            ]);

            Session::flash('success', 'Sửa giá thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function destroyId($id) {
       $data = Price::find($id);
       $data->delete();
       Session::flash('success', 'Xóa giá thành công');
    }
    
}