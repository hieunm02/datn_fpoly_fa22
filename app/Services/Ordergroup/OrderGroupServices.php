<?php

namespace App\Services\Ordergroup;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class OrderGroupServices
{
    public function getAll()
    {
        return  Product::with('menu')
            ->select('id', 'name', 'menu_id', 'price', 'price_sales', 'quantity', 'thumb', 'active')
            ->orderBy('id', 'DESC')->paginate(5);
    }
}