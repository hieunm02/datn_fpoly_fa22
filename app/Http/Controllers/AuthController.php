<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function googleredirect(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback(Request $request)
    {
        $userdata = Socialite::driver('google')->user();
        $user = User::where('email', $userdata->email)->where('auth_type', 'google')->first();
        Session::put('user_name', $userdata->name);
        if ($user) {
            //do login
            Auth::login($user);
            return redirect('/');
        } else {
            //register
            $uuid = Str::uuid()->toString();

            $user = new User();
            $user->name = $userdata->name;
            $user->email = $userdata->email;
            $user->password = Hash::make($uuid . now());
            $user->role = 1;
            $user->active = 0;
            $user->auth_type = 'google';
            $user->avatar = $userdata->avatar;
            $user->phone = '';
            $user->assignRole('customer');
            $user->point = 10;
            $user->save();
            Auth::login($user);
            return redirect('/');
        }
    }

    public function handleLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            Session::put('user_name', $user->name);
            return redirect()->route('index');
        } else {
            return redirect()->route('login')->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng!');
        }
    }

    public function handleRegister(Request $request) {
        $accounts = User::get('email');
        foreach($accounts as $acc) {
            if($acc->email == $request->email) {
                return redirect()->route('register')->with('error', 'Email này đã được sử dụng!');
            }
        }
        if($request->password != $request->password_old) {
            return redirect()->route('register')->with('error', 'Mật khẩu không khớp nhau');
        }else {
            User::create([
                'name' => str_replace('@gmail.com', '', $request->email),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'auth_type' => 'email',
                'role' => 1,
                'active' => 0,
                'avatar' => 'https://cdn-icons-png.flaticon.com/512/1946/1946429.png',
                'phone' => 0000000000,
            ]);
            return redirect()->route('login')->with('error', 'Đăng ký thành công!');
        }
    }
}
