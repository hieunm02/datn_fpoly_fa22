<?php


namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderGroupRequest;
use App\Models\Cart;
use App\Models\Floor;
use App\Models\OptionDetail;
use App\Models\Product;
use App\Models\Room;
use App\Models\Voucher;
use App\Services\Carts\CartService;
use App\Services\Ordergroup\OrderGroupCheckoutServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class OrderGroupCartController extends Controller
{
    public function __construct(OrderGroupCheckoutServices $OrderGroupCheckout)
    {
        $this->OrderGroupCheckout = $OrderGroupCheckout;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            $room = $request->room;
            //danh sách sản phẩm trong giỏ hàng
            $carts = $this->OrderGroupCheckout->getCarts($room);
            //danh sách thành viên trong nhóm
            $buildings = $this->OrderGroupCheckout->getBuilding();
            $total = 0;
            // $options = OptionDetail::all();
            $vouchers = Voucher::all();
            return view('client.order-group-checkout', compact('carts', 'total', 'buildings', 'vouchers'));
        } else {
            Session::flash('error', 'Bạn chưa đăng nhập');
            return redirect('/');
        }
    }

    public function getFloor(Request $request)
    {
        $id = $request->id;
        $floor = Floor::where('building_id', $id)->get();
        return response()->json($floor, 200);
    }
    public function getRoom(Request $request)
    {
        $floor_id = $request->floor_id;
        // $building_id = $request->building_id;->where('building_id', $building_id)
        $room = Room::where('floor_id', $floor_id)->get();
        return response()->json($room, 200);
    }

    public function checkOut(OrderGroupRequest $request)
    {
        $this->OrderGroupCheckout->checkOut($request);
        return redirect('/bills');
    }
}
