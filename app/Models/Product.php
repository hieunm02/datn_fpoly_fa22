<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected  $fillable = ['name', 'thumb', 'content', 'menu_id', 'price', 'price_sales', 'active', 'desc', 'quantity'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}