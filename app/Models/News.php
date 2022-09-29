<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'short_desc',
        'image_path',
        'content',
        'view',
        'user_id',
        'active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
