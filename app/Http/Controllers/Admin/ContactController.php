<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contact\AdminContactService;

class ContactController extends Controller
{
    protected $adminContactService;

    public function __construct(AdminContactService $adminContactService)
    {
        $this->adminContactService = $adminContactService;
    }

    public function index()
    {
        $contacts = $this->adminContactService->getAll();
        return view('admin.contacts.index', [
            'title' => "Danh sách liên hệ",
            'contacts' => $contacts
        ]);
    }
}
