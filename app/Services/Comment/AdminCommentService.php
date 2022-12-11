<?php

namespace App\Services\Comment;

use App\Models\Comment;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminCommentService
{
    public function getParent()
    {
        return Comment::where('parent_id', 0)->get();
    }
    public function getReact()
    {
        return Reaction::get();
    }

    public function getComment($id)
    {
        return Comment::where('product_id', $id)->get();
    }

    public function getNameUser($id)
    {
        return User::find($id)->name;
    }

    public function getComments($request)
    {
        $text_search = $request->get('text_search');
        $active_search = $request->get('active_search');
        if ($text_search == null) {
            $text_search = '';
        }
        $query = Comment::select('comments.id', 'comments.content', 'comments.user_id', 'comments.product_id', 'comments.parent_id', 'comments.active')
            ->with(['product', 'user', 'reactions'])
            ->join('products', 'products.id', '=', 'comments.product_id')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where(function($query) use ($text_search) {
                if ($text_search) {
                    $query->where('products.name', 'like', '%' . $text_search . '%')
                        ->orWhere('users.name', 'like', '%' . $text_search . '%');
                }
            });

        if ($active_search === '0' || $active_search === '1') {
            $query->where('comments.active', $active_search);
        }

        return $query->orderBy('comments.updated_at', 'DESC');
    }

    public function getAll()
    {
        return Comment::select('id', 'content', 'user_id', 'product_id', 'parent_id', 'active')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function removeComment($id)
    {
        try {
            $comment = Comment::find($id);
            $comment->delete();
            notify()->success('Xóa bình luận thành công.');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            return false;
        }

        return true;
    }
}
