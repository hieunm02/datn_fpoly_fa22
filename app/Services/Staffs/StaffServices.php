<?php

namespace App\Services\Staffs;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StaffServices
{
    public function getAll()
    {
        return User::select('id', 'name', 'email', 'auth_type', 'role', 'active')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function getStaff()
    {
        return User::select('id', 'name', 'email', 'role', 'active')
            ->where('role', '=', '1')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function create($request)
    {
        try {
            User::create([
                'name' => (string) $request->input('name'),
                'email' => (string) $request->input('email'),
                'password' => (string) Hash::make(12345678),
                'avatar' => (string) $request->input('path_image'),
                'role' => 1,
                'active' => 1
            ]);
            Session::flash('success', 'Tạo thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $id)
    {
        try {
            $newsModel = User::find($id);
            $newsModel->update([
                'name' => (string) $request->input('name'),
                'email' => (string) $request->input('email'),
                'role' => 1,
                'avatar' => (string) $request->input('avatar'),
                'active' => (string) $request->input('active')
            ]);
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function findStaff($id)
    {

        return User::find($id);
    }
}
