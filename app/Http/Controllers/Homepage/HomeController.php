<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Reaction;
use App\Models\Thumb;
use App\Services\Comments\CommentService;
use App\Services\Menu\MenuServices;
use App\Services\Products\ProductServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return view('client.product-detail', compact('product', 'thumb', 'comment', 'products', 'react'));
        }
        return view('client.product-detail', compact('product', 'thumb', 'products', 'react'));
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

    public function createComment(Request $request)
    {
        $comment = new Comment();

        $comment->fill(
            [
                'content' => (string)$request->content,
                'product_id' => (int)$request->product_id,
                'parent_id' => isset($request->parent_id) ? $request->parent_id : null,
                'user_id' => (int)$request->user_id,
                'active' => 0,
            ]
        );

        $comment->save();

        return response()->json([
            'success' => 'Bình luận sản phảm thành công.',
            'date' => date('Y-m-d h:i:s'),
            'user_id' => $this->commentService->getNameUser($request->user_id),
            'comment_id' => $comment->id
        ]);
    }

    public function deleteComment(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->delete();
        return response()->json();
    }
}