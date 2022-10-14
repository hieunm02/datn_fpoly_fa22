<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\Contact\UserContactService;

class ContactController extends Controller
{
    protected $userContactService;

    public function __construct(UserContactService $userContactService)
    {
        $this->userContactService = $userContactService;
    }

    public function store(ContactRequest $request)
    {
        $this->userContactService->create($request);
        return view('client.contact-us', [
            'title' => 'Form liên hệ',
        ]);
    }
}
