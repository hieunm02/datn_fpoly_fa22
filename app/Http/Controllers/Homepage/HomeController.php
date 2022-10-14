<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Reaction;
use App\Models\Thumb;
use App\Services\Comments\CommentService;
use App\Services\Menu\MenuServices;
use App\Services\Products\ProductServices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productService, $commentService;

    public function __construct(ProductServices $productService, MenuServices $menuService, CommentService $commentService)
    {
        $this->productService = $productService;
        $this->menuService = $menuService;
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->getAll();
        $productBtm = $this->productService->getAll();
        $menus = $this->menuService->getMenuIndex();
        return view('client.index', compact('products', 'productBtm', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $react = $this->commentService->getReact(); // lấy ra icon like có id là 1

        $product = $this->productService->getById($id);

        $thumb = Thumb::where('product_id', $id)->get();
        $comment = Comment::with('user', 'reactions')->where('product_id', $product->id)->get();
        $products = $this->productService->getAll();
//        foreach ($comment as $key) {
//            $countReact = $key->reactions->count();
//            return view('client.product-detail', compact('product', 'thumb', 'comment', 'products', 'react', 'countReact'));
//        }
        if ($comment) {
            return view('client.product-detail', compact('product', 'thumb', 'comment', 'products', 'react' ));
        }
        return view('client.product-detail', compact('product', 'thumb', 'products', 'comment', 'react'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function comment(Request $request)
    {
        $this->commentService->create($request);
        return redirect()->back();
    }

    public function editCmt($product, $id)
    {
        $comment = Comment::find($id);
        $product = Product::find($product);
        return response()->json([
            'product' => $product->id,
            'comment' => $comment,
            'id' => $comment->id,
        ]);
    }

    public function updateCmt(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->update($request->all());
        return response()->json(['data' => $comment, 'comment' => $request->all(), 'commentid' => $id], 200);
    }

    public function react(Request $request)
    {
        $comment = new Comment();
        $comment->reactions()->attach(1, ['comment_id' => $request->comment_id]);
        return redirect()->back();
    }

}
