<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomChat extends Model
{
    use HasFactory;
    protected $table = "room_chat";
    public $timestamps = FALSE;
    protected $fillable = [
        'room_id',
        'name',
        'avatar',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'room_message_id', 'room_id');
    }
}
