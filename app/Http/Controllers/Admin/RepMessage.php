<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class RepMessage extends Controller
{
    public function repMessage(Request $request)
    {
        Message::create([
            'user_id' => $request->user_id,
            'room_message_id' => $request->room_id,
            'message' => $request->message,
            'avatar' => $request->avatar,
        ]);
    }
}
