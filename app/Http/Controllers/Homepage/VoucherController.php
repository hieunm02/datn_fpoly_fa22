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
        $vouchers = Voucher::with('user')->get();
        dd($vouchers);
        $userVoucher = [];
        $adminVoucher = [];
        $flag = true;
        foreach ($vouchers as $voucher) {
            if($voucher->user()){
                $adminVoucher[] = $voucher;
            }else{
                $userVoucher[] = $voucher;
            }
            // foreach ($voucher->user as $a) {
            //     dd($vouchers->count());
            //     for ($i = 0; $i < $vouchers->count(); $i++) {
            //         if ($a->pivot->voucher_id == $vouchers[$i]->id) {
            //             $userVoucher[] = $vouchers[$i];
            //             break;
            //         } elseif ($i == $vouchers->count() - 1) {
            //             $adminVoucher = $vouchers[$i];
            //         }
            //     }
            // }
            // if ($voucher->user()) {
            //     $userVoucher[] = $voucher;
            //     $flag = false;
            // }
        }
        // if ($flag == false) {
        //     foreach ($vouchers as $voucher) {
        //         if ($voucher->user->isEmpty()) {
        //             $adminVoucher[] = $voucher;
        //             break;
        //         }
        //     }
        // }
        dd($userVoucher);
        // return view('/offers', compact());
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

        // Random voucher
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            . '0123456789');
        shuffle($seed);
        $rand = '';
        foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];
        $discount = $request->point_exchange / 10;

        $lastInsertId = Voucher::create([
            'code' => $rand,
            'description' => 'Voucher đổi điểm',
            'discount' => $discount,
            'thumb' => '',
            'active' => 0,
            'menu_id' => null,
            'quantity' => 1,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->subHours(1),
        ])->id;


        $user = User::find(Auth::user()->id);
        $user->point = $user->point - $request->point_exchange;
        $user->voucher()->attach($lastInsertId);
        $user->save();
        return response()->json([]);
    }
}
