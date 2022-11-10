<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\RoomChat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function message($room_id = null)
    {
        $rooms = RoomChat::with('messages')->get();
        $messages = Message::where('room_message_id', $room_id)->get();
        $room_name = RoomChat::select('name')->where('room_id', $room_id)->first();
        $room_avatar = RoomChat::select('avatar')->where('room_id', $room_id)->first();
        return view('admin.chats.message', [
            'title' => 'Tin nhắn',
            'rooms' => $rooms,
            'messages' => $messages,
            'room_id' => $room_id,
            'room_name' => $room_name,
            'room_avatar' => $room_avatar,
        ]);
    }
}
