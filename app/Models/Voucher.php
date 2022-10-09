<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'code', 'quantity', 'thumb', 'description', 'active', 'discount', 'menu_id', 'start_time', 'end_time'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
