<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\User;
use App\Models\UserVoucher;
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
                if (strtotime($voucher->end_time) > strtotime(Carbon::now()->timezone('Asia/Ho_Chi_Minh'))) {
                    $publicVouchers[] = $voucher;
                }
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

    public function applyVoucher(Request $request)
    {
        $vouchers = Voucher::all();
        if (!$request->code) {
            $required = [
                'required' => 'Mã chưa được nhập!',
            ];
            return response()->json(['errors' => $required], 500);
        }
        // Không tồn tại
        if (!$vouchers->contains('code', $request->code)) {
            $isNotExist = [
                'isNotExist' => 'Mã giảm giá không tồn tại hoặc đã được sử dụng!',
            ];
            return response()->json(['errors' => $isNotExist], 500);
        } else {   // Tồn tại mã
            $voucher = Voucher::where('code', $request->code)->first();

            if (!Carbon::now()->isSameDay($voucher->start_time) || $voucher->active != 0) {    // Khả dụng
                $isNotTime = [
                    'isNotTime' => 'Mã không khả dụng!',
                ];
                return response()->json(['errors' => $isNotTime], 500);
            } else {
                if (Carbon::now()->isSameDay($voucher->end_time)) {  // Hết hạn
                    $isExpirated = [
                        'isExpirated' => 'Mã hết hạn sử dụng!',
                    ];
                    return response()->json(['errors' => $isExpirated], 500);
                }
            }

            if ($voucher->quantity == 0) {
                $isOutOfStock = [
                    'isOutOfStock' => 'Mã hết lượt sử dụng!',
                ];
                return response()->json(['errors' => $isOutOfStock], 500);
            }
        }
        return response()->json(['voucher' => $voucher], 200);
    }
}
