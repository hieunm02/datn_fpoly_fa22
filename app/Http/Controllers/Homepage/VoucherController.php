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
        if ($request->point_exchange > 500) {
            $dis = [
                'dis' => 'Điểm quy đổi không vượt quá 500 điểm!',
            ];
            return response()->json(['errors' => $dis], 500);
        }
        if ($request->point_exchange == '') {
            $required = [
                'required' => 'Ô nhập không được để trống!',
            ];
            return response()->json(['errors' => $required], 500);
        }
        if ($request->point_exchange % 100 !== 0) {
            $multiple = [
                'multiple' => 'Gía trị nhập phải là bội số của 100!',
            ];
            return response()->json(['errors' => $multiple], 500);
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $discount = $request->point_exchange / 10;

        $lastInsertId = Voucher::create([
            'code' => $randomString,
            'description' => 'Voucher đổi điểm',
            'discount' => $discount,
            'thumb' => '',
            'active' => 0,
            'menu_id' => null,
            'quantity' => 1,
            'start_time' => Carbon::now()->timezone('Asia/Ho_Chi_Minh'),
            'end_time' => Carbon::now()->timezone('Asia/Ho_Chi_Minh')->addHour(),
        ])->id;
        $user = User::find(Auth::user()->id);
        $user->point = ($user->point) - ($request->point_exchange);
        $user->vouchers()->attach($lastInsertId);
        $user->save();
        return response()->json(['user' => $user], 200);
    }
}
