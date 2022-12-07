<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Services\Comment\AdminCommentService;

use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected $commentService;

    public function __construct(AdminCommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->status == 200) {
            $comments = $this->commentService->getComments($request)->get();
            return response()->json([
                'comments' => $comments,
            ]);
        } else {
            $comments = $this->commentService->getComments($request)->paginate(5);
            return view('admin.comments.index', [
                'title' => 'Danh sách bình luận',
                'comments' => $comments
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commnent = Comment::find($id);
        $this->commentService->removeComment($id);
        return response()->json(['model' => $commnent]);
    }

    public function changeActive(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        if ($request->active == 1) {
            $comment->active = 0;
            $value = $comment->active;
            $btnActive = 'bi-unlock-fill';
            $btnRemove = 'bi-lock-fill';
            $color = 'green';
        } else {
            $comment->active = 1;
            $value = $comment->active;
            $btnActive = 'bi-unlock-fill';
            $btnActive = 'bi-lock-fill';
            $btnRemove = 'bi-unlock-fill';
            $color = 'red'; 
        }
        $comment->save();
        return response()->json([
            'btnActive' => $btnActive,
            'btnRemove' => $btnRemove,
            'value' => $value,
            'color' => $color,
        ]);
    }
}