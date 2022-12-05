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

    public function getUsers($request)
    {
        $text_search = $request->get('text_search');
        $active_search = $request->get('active_search');
        if ($text_search == null) {
            $text_search = '';
        }
        $query = User::where('name', 'like', '%' . $text_search . '%');

        if ($active_search === '0' || $active_search === '1') {
            $query->where('active', $active_search);
        }

        return $query->orderBy('updated_at', 'DESC');
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
