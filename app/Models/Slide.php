<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'product_id',
        'url',
        'thumb',
        'sort_by',
        'active'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}