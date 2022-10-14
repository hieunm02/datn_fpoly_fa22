<?php

namespace App\Services\Comments;

use App\Models\Comment;
use App\Models\Reaction;
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
        return Reaction::select('icon')->Paginate(6);
    }

    public function getComment($id)
    {
        return Comment::where('product_id', $id)->get();
    }
    public function create($request)
    {
        try {
            Comment::create([
                'content' => (string)$request->input('content'),
                'parent_id' => (int)$request->input('parent_id'),
                'user_id' => (string)Auth::user()->id,
                'active' => (string)$request->input('active'),
            ]);

            Session::flash('success', 'Comment thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $id)
    {
        try {
            $data = Menu::find($id);
            // dd($data);
            $data->name = (string)$request->input('name');
            $data->parent_id = (int)$request->input('parent_id');
            $data->thumb = (string)$request->input('thumb');
            $data->active = (string)$request->input('active');
            $data->save();
            // Menu::create([
            //     'name' => (string) $request->input('name'),
            //     'parent_id' => (int) $request->input('parent_id'),
            //     'thumb' => (string) $request->input('thumb'),
            //     'active' => (string) $request->input('active'),
            // ]);

            Session::flash('success', 'Sửa danh mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function getId($id)
    {
        return Menu::find($id);
    }

    public function destroyId($id)
    {
        // dd($id);
        $data = Menu::find($id);
        $data->delete();
        Session::flash('success', 'Xóa danh mục thành công');
    }
}
