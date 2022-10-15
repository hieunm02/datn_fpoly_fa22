<?php

namespace App\Services\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\Session;

class AdminCommentService
{
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
            Session::flash('success', 'Xóa bình luận thành công.');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return false;
        }

        return true;
    }
}