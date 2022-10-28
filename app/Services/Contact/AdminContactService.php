<?php

namespace App\Services\Contact;

use App\Models\Contact;

class AdminContactService 
{
    public function getAll()
    {
        return Contact::select('id', 'name', 'email', 'phone', 'content', 'status')
                        ->orderByDesc('id')
                        ->paginate(10);
    }
    public function getId($id)
    {
        return Contact::find($id);
    }
}