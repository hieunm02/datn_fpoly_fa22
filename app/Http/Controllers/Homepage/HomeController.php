<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\CommentReaction;
use App\Models\CommentRection;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductOptionDetail;
use App\Models\Reaction;
use App\Models\Slide;
use App\Models\Thumb;
use App\Services\Comment\AdminCommentService;
use App\Services\Menu\MenuServices;
use App\Services\Products\ProductServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $productService;
    protected $commentService;

    public function __construct(
        ProductServices $productService,
        MenuServices $menuService,
        AdminCommentService $commentService
    ) {
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
        $slides = Slide::with('product')->get();
        return view('client.index', compact('products', 'productBtm', 'menus', 'slides'));
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
        $reacts = Reaction::all(); // lấy ra icon like có id là 1
        $order = OrderProduct::with('product')->where('product_id', $id)->get();
        // dd($order);
        $product = $this->productService->getById($id);
        $thumb = Thumb::where('product_id', $id)->get();
        $comment = Comment::with('user', 'reactions')
            ->where('product_id', $product->id)
            ->where('active', 0)
            ->get();
        $products = $this->productService->getAll();
        $product_option_details = DB::table('product_option_details')
            ->where('product_id', $product->id)
            ->join('option_details', 'product_option_details.option_detail_id', '=', 'option_details.id')
            ->select('product_option_details.*', 'option_details.value', 'option_details.price')
            ->get();
        // dd($product_option_details);
        return view('client.product-detail', compact('product', 'thumb', 'comment', 'products', 'reacts', 'product_option_details', 'order'));
    }

    //Comment

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
            'date' => Carbon::now()->timezone('Asia/Ho_Chi_Minh')->timestamp,
            'user_id' => $this->commentService->getNameUser($request->user_id),
            'comment_id' => $comment->id,
            'avatar' => $comment->user->avatar,
            'id_user' => $comment->user->id,
            'product_name' => $comment->product->name,
            'product_id' => $comment->product->id,
        ]);
    }

    public function editComment(Request $request)
    {
        $comment = Comment::find($request->id);

        $comment->content = $request->value;
        $comment->save();

        return response()->json();
    }

    public function deleteComment(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->delete();
        return response()->json();
    }

    public function likeComment(Request $request)
    {
        $cmtReaction = new CommentReaction();
        $cmtReaction->comment_id = $request->id;
        $cmtReaction->reaction_id = $request->reaction_id;

        $cmtReaction->save();
        return response()->json();
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('name', 'LIKE', '%' . $request->result . '%')->get();
            $result = '';
            if ($products) {
                foreach ($products as  $product) {
                    $result .= '
                <div class="col-md-3 pb-3">
                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                        <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                                        <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                        <a href="restaurant.html">
                                            <img alt="#" src="http://127.0.0.1:8000/' . $product->thumb . '" class="img-fluid item-img w-100">
                                        </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="/products/' . $product->id . '/product-detail" class="text-black">' . $product->name . '
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-1 small">• North • Hamburgers</p>
                                            <p class="text-gray mb-1 rating">
                                            <ul class="rating-stars list-unstyled">
                                                <li>
                                                    <i class="feather-star star_active"></i>
                                                    <i class="feather-star star_active"></i>
                                                    <i class="feather-star star_active"></i>
                                                    <i class="feather-star star_active"></i>
                                                    <i class="feather-star"></i>
                                                </li>
                                            </ul>
                                            </p>
                                        </div>
                                        <div class="list-card-badge">
                                            <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                ';
                }
            }
        }
        return response()->json(['result' => $result], 200);
    }
}
