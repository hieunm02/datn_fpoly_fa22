<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserServices
{
    public function getAll()
    {
        return User::select('id', 'name', 'email', 'auth_type', 'role', 'active')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function update($request, $id){
        try {
            $data = User::find($id);
            $data->update([
                'phone' => (string) $request->input('phone'),
            ]);

            notify()->success('Cập nhập profile thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
}
