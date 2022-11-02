<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $name = "Thống kê số lượng sản phẩm theo danh mục";
        $title = 'Dashboard';
        $cates = DB::table('products')
            ->join('menus', 'products.menu_id', '=', 'menus.id')
            ->groupBy('menus.name')
            ->get([
                'menus.name',
                DB::raw('COUNT(menu_id) as value')
            ]);
        return view('admin.dashboard', [
            'title' => $title,
            'cates' => $cates,
            'name' => $name
        ]);
    }
}
