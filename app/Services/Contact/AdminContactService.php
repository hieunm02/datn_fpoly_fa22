<?php

namespace App\Services\Contact;

use App\Models\Contact;

class AdminContactService 
{
    public function getAll()
    {
        return Contact::select('id', 'name', 'email', 'phone', 'content')
                        ->orderByDesc('id')
                        ->paginate(10);
    }
}