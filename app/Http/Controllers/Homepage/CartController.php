<?php


namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Floor;
use App\Models\OptionDetail;
use App\Models\Product;
use App\Models\Room;
use App\Services\Carts\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct(CartService $CartServices)
    {
        $this->CartServices = $CartServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            $carts = $this->CartServices->getCartUser();
            $buildings = $this->CartServices->getBuilding();
            $total = 0;
            $options = OptionDetail::all();
            return view('client.checkout', compact('carts', 'total', 'buildings', 'options'));
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if (Auth::user()) {
            $this->CartServices->create($request);
            $carts = $this->CartServices->getCartUser();
            return response()->json(['carts' => $carts], 200);
        } else {
            Session::flash('error', 'Bạn chưa đăng nhập');
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (Auth::user()) {
            $this->CartServices->update($request);
            $carts = $this->CartServices->getCartUser();
            $mess = "Cập nhật số lượng thành công!";
            return response()->json([
                'mess' => $mess,
                'carts' => $carts
            ], 200);
        } else {
            Session::flash('error', 'Bạn chưa đăng nhập');
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart)
    {
        $data = Cart::find($cart);
        $prd = Product::find($cart);
        $data->delete();
        $carts = $this->CartServices->getCartUser();
        $mess = "Xóa sản phẩm thành công!";
        return response()->json([
            'mess' => $mess,
            'carts' => $carts,
            'prd' => $prd
        ], 200);
    }
}
