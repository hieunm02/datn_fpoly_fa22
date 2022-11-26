<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderGroup extends Model
{
    use HasFactory;
    protected $table = 'order_group';
    protected $fillable = [
        'room',
        'user_id',
        'user_name',
        'user_avatar',
        'product_id',
        'role',
    ];

    public $timestamps = FALSE;
}
