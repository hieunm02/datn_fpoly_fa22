<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    public function getList()
    {
        $data['products'] = Product::with('menu')->paginate(9);

        return view('client.list-products', $data);
    }
}