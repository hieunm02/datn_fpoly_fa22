<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'option_id',
        'price',
        // 'quantity'
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
