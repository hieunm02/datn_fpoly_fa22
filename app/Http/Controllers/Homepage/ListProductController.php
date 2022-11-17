<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    public function getList(Request $request)
    {
        if ($request) {
            $data['products'] = Product::filter($request)->with('menu')->get();
        } 
        return view('client.list-products', $data);
    }

    public function getListMenu($id)
    {
        $data['products'] = Product::with('menu')->where('menu_id', '=', $id)->paginate(9);
        $data['name'] = Menu::find($id)->name;
        return view('client.list-products', $data);
    }
}
