<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";

        $month = Carbon::now()->month;
        //thống kê sản phẩm theo tháng
        $orderMonth = DB::table('orders')
            ->whereMonth('created_at', '=', $month)->where('status_id', 1)
            ->count();

        $productMonth = OrderProduct::select('price', 'quantity', 'total', 'orders.status_id')
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->whereMonth('order_products.created_at', '=', $month)
            ->where('status_id', 1)
            ->get();

        $qty = 0; // số sản phẩm bán trong tháng
        $total = 0; // tổng tiền bán trong tháng
        foreach ($productMonth as $it) {
            $qty += $it->quantity;
            $total += $it->total;
        }
        // dd($qty, $total);
        return view('admin.dashboard', [
            'title' => $title,
            'orderMonth' => $orderMonth,
            'month' => $month,
            'qty' => $qty,
            'total' => $total
        ]);
    }

    public function filter(Request $request)
    {
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->addDay(1)->toDateString();

        // if($request->value == 'today') { 

        // }else
        if ($request->value == '7ngay') {
            $get = OrderProduct::whereBetween('created_at', [$sub7day, $now])->orderBy('created_at', 'ASC')->get();
            $start = $sub7day;
            $end = $now;
            $titleDashboard = "Thống kê trong 7 ngày qua";
        } elseif ($request->value == 'thangtruoc') {
            $get = OrderProduct::whereBetween('created_at', [$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('created_at', 'ASC')->get();
            $start = $dau_thangtruoc;
            $end = $cuoi_thangtruoc;
            $titleDashboard = "Thống kê trong tháng trước";
        } elseif ($request->value == 'thangnay') {
            $get = OrderProduct::whereBetween('created_at', [$dauthangnay, $now])->orderBy('created_at', 'ASC')->get();
            $start = $dauthangnay;
            $end = $now;
            $titleDashboard = "Thống kê trong tháng này";
        } elseif ($request->value == '365ngay') {
            $get = OrderProduct::whereBetween('created_at', [$sub365day, $now])->orderBy('created_at', 'ASC')->get();
            $start = $sub365day;
            $end = $now;
            $titleDashboard = "Thống kê trong 1 năm qua";
        }

        $order = Order::whereBetween('created_at', [$start, $end])->where('status_id', 1)
            ->count();

        $product = OrderProduct::select('price', 'quantity', 'total', 'orders.status_id')
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->whereBetween('order_products.created_at', [$start, $end])
            ->where('status_id', 1)
            ->get();
        $qty = 0; // số sản phẩm bán trong tháng
        $total = 0; // tổng tiền bán trong tháng
        foreach ($product as $it) {
            $qty += $it->quantity;
            $total += $it->total;
        }
        foreach ($get as $value) {
            $chart_data[] = array(
                'quantity' => $value->quantity,
                'price' => $value->price,
                'date' => $value->created_at->toDateString(),
                'total' => $value->total,
            );
        }
        return response()->json([
            'chart_data' => $chart_data,
            'order' => $order,
            'qty' => $qty,
            'total' => $total,
            'titleDashboard' => $titleDashboard,
        ], 200);
    }

    public function filterday(Request $request)
    {
        if ($request->value == 'today') {
            $now = Carbon::now();
            $get = OrderProduct::select('nameProduct', 'price', 'quantity', 'total')
            ->whereMonth('created_at', '=', $now->month)
            ->whereDay('created_at', '=', $now->day)
            ->whereYear('created_at', '=', $now->year)
            ->orderBy('created_at', 'ASC')->get();
        }else {
            $get = OrderProduct::select('nameProduct', 'price', 'quantity', 'total')->whereBetween('created_at', [$request->from, $request->value])->orderBy('created_at', 'ASC')->get();
        }
        return response()->json(['data' => $get], 200);
    }
}
