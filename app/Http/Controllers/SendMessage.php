<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\RoomChat;
use Illuminate\Http\Request;

class SendMessage extends Controller
{
    public function sendMessage(Request $request)
    {
        $room = RoomChat::where('room_id', $request->id)->get();
        if($room->all() == []){
            RoomChat::create([
                'room_id' => $request->id,
                'name' => $request->name,
                'avatar' => $request->avatar,
            ]);
        }
        Message::create([
            'user_id' => $request->id,
            'room_message_id' => $request->id,
            'message' => $request->message,
            'avatar' => $request->avatar,
        ]);
    }
}
