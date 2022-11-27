<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Services\Products\ProductServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServices $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->status == 200) {
            $products = $this->productService->getProducts($request)->get();
            return response()->json([
                'products' => $products,
            ]);
        } else {
            $products = $this->productService->getProducts($request)->paginate(5);
            return view('admin.products.index', [
                'title' => 'Danh sách sản phẩm',
                'products' => $products
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo mới sản phẩm';
        $prices = $this->productService->getPrice();
        $menus = $this->productService->getMenu();
        return view('admin.products.create', compact('prices', 'menus', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $this->productService->create($request);
        if (!$data) {
            return redirect()->back();
        }
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['title'] = 'Cập nhật sản phẩm';
        $data['product'] = $this->productService->getById($id);
        $data['prices'] = $this->productService->getPrice();
        $data['menus'] = $this->productService->getMenu();
        $data['thumbnails'] = $this->productService->getThumbByProduct($id);
        return view('admin.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $this->productService->update($request, $id);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productService->getById($id);
        $this->productService->delete($id);
        return response()->json(['model' => $product]);
    }

    public function changeActive(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($request->active == 1) {
            $product->active = 0;
            $value = $product->active;
            $btnActive = 'bi-lock-fill';
            $btnRemove = 'bi-unlock-fill';
            $color = 'red';
        } else {
            $product->active = 1;
            $value = $product->active;
            $btnActive = 'bi-unlock-fill';
            $btnRemove = 'bi-lock-fill';
            $color = 'green';
        }
        $product->save();
        return response()->json([
            'btnActive' => $btnActive,
            'btnRemove' => $btnRemove,
            'value' => $value,
            'color' => $color,
        ]);
    }

    public function deleteAllPage(Request $request)
    {
        try {
            foreach ($request->product_ids as $item) {
                Product::find($item)->delete();
            }
            return response()->json([
                'success' => 'Xóa thành công.'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
