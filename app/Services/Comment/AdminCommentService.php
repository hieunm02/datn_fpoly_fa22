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
