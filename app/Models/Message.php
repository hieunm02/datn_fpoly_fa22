<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = "messages";
    protected $fillable = [
        'user_id',
        'room_message_id',
        'message',
        'avatar',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function room()
    {
        return $this->belongsTo(Roommessage::class, 'room_id', 'room_message_id');
    }
}
