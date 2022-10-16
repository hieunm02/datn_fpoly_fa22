<?php

namespace App\Services\Comments;

use App\Models\Comment;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentService
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

    public function create($request, $product_id)
    {
        try {
            Comment::create([
                'content' => (string)$request->content,
                'product_id' => $product_id,
                'parent_id' => isset($request->parent_id) ? $request->parent_id : null,
                'user_id' => 1,
                // Auth::user()->id
                'active' => 0,
            ]);

            Session::flash('success', 'Comment thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }
}