<?php

namespace App\Services\Staffs;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
        return User::select('id', 'name', 'email', 'role', 'active', 'avatar')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function getStaffs($request)
    {
        $text_search = $request->get('text_search');
        $active_search = $request->get('active_search');
        if ($text_search == null) {
            $text_search = '';
        }
        $query = Role::where('id', 2)->first()->users()
            ->where('name', 'like', '%' . $text_search . '%');
        if ($active_search === '0' || $active_search === '1') {
            $query->where('active', $active_search);
        }

        return $query->orderBy('updated_at', 'DESC');
    }

    public function create($request)
    {
        try {
            $user = User::create([
                'name' => (string) $request->input('name'),
                'email' => (string) $request->input('email'),
                'phone' => (string) $request->input('phone'),
                'password' => (string) Hash::make(12345678),
                'avatar' => (string) $request->input('image_path'),
                'active' => 0,
                'role' => 1
            ]);
            $user->assignRole('staff');
            notify()->success('Tạo thành công');
        } catch (\Exception $err) {
            notify()->error($err->getMessage());
            Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $id)
    {
        try {
            $staffModel = User::find($id);
            $staffModel->update([
                'name' => (string) $request->name,
                'phone' => (string) $request->phone,
                'image_path' => (string) $request->image_path,
                'avatar' => (string) $request->input('image_path'),
            ]);
            notify()->success('Cập nhật thành công');
        } catch (\Exception $err) {
            notify()->error($err->getMessage());
            return false;
        }
    }

    public function findStaff($id)
    {
        return User::find($id);
    }
}
