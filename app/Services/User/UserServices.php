<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserServices 
{
    public function getAll()
    {
        return User::select('id', 'name', 'email', 'auth_type', 'role', 'active')
                    ->orderByDesc('id')
                    ->paginate(5);
    }
} 
