<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\Contact\AdminContactService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\HtmlString;

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
    public function show($id)
    {
        $contacts = $this->adminContactService->getId($id);
        return view('admin.contacts.sendMail', [
            'title' => "Send Mail",
            'contacts' => $contacts
        ]);
    }

    public function sendMail(Request $request)
    {
        $mailData = [
            "title" => 'Phản hồi liên hệ của ' . $request->name,
            'name' => $request->name,
            "content" => new HtmlString($request->content),
        ];

        Mail::to($request->email)->send(new SendMail($mailData));
        // dd("Mail Sent Successfully!");
        $contact = Contact::find($request->id);
        $contact->status = 1;
        $contact->save();
        
        Session()->flash('success', 'Phản hồi tới khách hàng ' . $request->name . ' thành công');
        return redirect()->route('admin.contacts.index');
    }
}
