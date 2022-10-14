<?php

namespace App\Services\Comment;

use App\Models\Comment;

class AdminCommentService
{
    public function getAll()
    {
        return Comment::select('id', 'content', 'user_id', 'product_id', 'parent_id')
            ->orderByDesc('id')
            ->paginate(5);
    }
}