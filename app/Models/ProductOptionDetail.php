<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'option_id',
        'option_detail_id',
    ];
}
