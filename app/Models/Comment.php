<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'product_id',
        'parent_id',
        'active'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}