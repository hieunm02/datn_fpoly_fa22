<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VoucherController extends Controller
{

    public function index()
    {
        $vouchers = Voucher::all();
        $privateVouchers = [];
        $publicVouchers = [];
        foreach ($vouchers as $voucher) {
            if (($voucher->users)->isEmpty()) {
                $publicVouchers[] = $voucher;
            } else {
                $privateVouchers[] = $voucher;
            }
        }
        return view('client.offers', compact('privateVouchers', 'publicVouchers', 'vouchers'));
    }
    public function exchangeVoucher(Request $request)
    {
        if ($request->point_exchange > Auth::user()->point) {
            $enough = [
                'enough' => 'Điểm của bạn không đủ!',
            ];
            return response()->json(['errors' => $enough], 500);
        }
        if ($request->point_exchange > 100) {
            $dis = [
                'dis' => 'Điểm quy đổi không vượt quá 100 điểm!',
            ];
            return response()->json(['errors' => $dis], 500);
        }
        if ($request->point_exchange == '') {
            $required = [
                'required' => 'Ô nhập không được để trống!',
            ];
            return response()->json(['errors' => $required], 500);
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        if ($request->point_exchange == 100) {
            $discount = 99;
        } else {
            $discount = $request->point_exchange;
        }

        $lastInsertId = Voucher::create([
            'code' => $randomString,
            'description' => 'Sử dụng voucher này để được giảm tới ' . $discount . '% giá trị đơn hàng',
            'discount' => $discount,
            'thumb' => '',
            'active' => 0,
            'menu_id' => null,
            'quantity' => 1,
            'start_time' => null,
            'end_time' => null,
        ])->id;
        $user = User::find(Auth::user()->id);
        $user->point = ($user->point) - ($request->point_exchange);
        $user->vouchers()->attach($lastInsertId);
        $user->save();
        return response()->json(['user' => $user], 200);
    }
}
