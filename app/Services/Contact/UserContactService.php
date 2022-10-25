<?php

namespace App\Services\Contact;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserContactService 
{
    public function create($request)
    {
        try {
            Contact::create($request->all());
            Session::flash('success', "Đã liên hệ với quản trị viên, vui lòng chờ phản hồi");
        } catch (\Exception $err) {
            Session::flash('error', "Liên hệ không thành công, vui lòng thử lại");
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
}