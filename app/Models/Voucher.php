<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_voucher', 'voucher_id', 'user_id');
    }
}
