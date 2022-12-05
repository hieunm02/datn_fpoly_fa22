<?php

namespace App\Services\Contact;

use App\Models\Contact;

class AdminContactService 
{
    public function getAll()
    {
        return Contact::select('id', 'name', 'email', 'phone', 'content', 'status')
                        ->orderByDesc('id')
                        ->paginate(6);
    }
    public function getContacts($request)
    {
        $text_search = $request->get('text_search');
        $active_search = $request->get('active_search');
        if ($text_search == null) {
            $text_search = '';
        }
        $query = Contact::where('name', 'like', '%' . $text_search . '%');

        return $query->orderBy('updated_at', 'DESC');
    }
    public function getId($id)
    {
        return Contact::find($id);
    }
}