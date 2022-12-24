<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Floor;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\OrderGroup;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use App\Services\Carts\CartService;
use App\Services\Ordergroup\OrderGroupServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class OrderGroupController extends Controller
{
    protected $orderGroupService;
    protected $cartService;
    public function __construct(OrderGroupServices $orderGroupService, CartService $CartServices)
    {
        $this->orderGroupService = $orderGroupService;
        $this->CartServices = $CartServices;
    }

    public function getProducts()
    {
        $url = URL::full();
        //danh sách sản phẩm trong giỏ hàng
        $carts = $this->orderGroupService->getCarts();
        //danh sách thành viên trong nhóm
        $listMembers = $this->orderGroupService->getListMembers($url);
        //danh sách sản phẩm
        $products = $this->orderGroupService->getAll();
        //danh sách địa chỉ
        $buildings = $this->CartServices->getBuilding();
        $total = 0;
        $options = OptionDetail::all();

        return view('client.order-group', [
            'title' => 'Đặt hàng nhóm',
            'products' => $products,
            'carts' => $carts,
            'listMembers' => $listMembers,
            'buildings' => $buildings,
            'options' => $options,
            'total' => $total,
        ]);
    }

    public function quickview(Request $request)
    {
        // tìm xem sản phẩm này đã có trong giỏ hàng hay chưa 
        $this->orderGroupService->quickView($request);
    }

    public function createGroup(Request $request)
    {
        $this->orderGroupService->createGroup($request);
    }

    public function addToCart(Request $request)
    {
        $this->orderGroupService->addToCart($request);
    }

    public function listMember(Request $request)
    {
        $this->orderGroupService->listMember($request);
    }
}
