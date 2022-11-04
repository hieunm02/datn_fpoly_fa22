<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
            ->get(['menus.name', DB::raw('COUNT(menu_id) as value')]);
        
        // $range = Carbon::now()->subDays(30);
        $month = Carbon::now()->month;
        // return ($range);

        //thống kê sản phẩm theo tháng
        $orderMonth = DB::table('orders')
            ->whereMonth('created_at', '=', $month)->where('status_id', 1)
            ->count();
        // ->groupBy('date')
        // ->orderBy('date', 'ASC')
        // ->get([
        //     DB::raw('Date(created_at) as date'),
        //     DB::raw('COUNT(*) as value')
        // ]);
        // dd($month);
        return view('admin.dashboard', [
            'title' => $title,
            'cates' => $cates,
            'name' => $name,
            'orderMonth' => $orderMonth,
            'month' => $month,

        ]);
    }
}
