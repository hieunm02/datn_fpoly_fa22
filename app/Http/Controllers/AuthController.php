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
            echo "Sai";
        }
    }
}
