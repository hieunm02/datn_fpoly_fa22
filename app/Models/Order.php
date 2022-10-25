<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'email',
        'code',
        'name',
        'phone',
        'address',
        'user_id',
        'status_id',
        'shipper_id',
        'voucher',
        'note',
    ];

    public function status()
    {
        return $this->hasMany(OrderStatus::class);
    }
}