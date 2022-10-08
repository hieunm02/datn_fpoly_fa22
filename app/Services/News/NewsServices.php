<?php

namespace App\Services\News;

use App\Models\Menu;
use App\Models\News;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class NewsServices
{
    public function getAll()
    {
        return News::select('id', 'title', 'image_path', 'active')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function create($request)
    {
        try {
            News::create([
                'title' => (string) $request->input('title'),
                'user_id' => 1,
                'short_desc' => (string) $request->input('short_desc'),
                'content' => (string) $request->input('content'),
                'image_path' => (string) $request->input('image_path'),
                'active' => (int) $request->input('active'),
            ]);

            Session::flash('success', 'Tạo thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $id)
    {
        try {
            $newsModel = News::find($id);
            $newsModel->update([
                'title' => (string) $request->input('title'),
                'user_id' => 1,
                'short_desc' => (string) $request->input('short_desc'),
                'content' => (string) $request->input('content'),
                'image_path' => (string) $request->input('image_path'),
                'active' => (int) $request->input('active'),
            ]);
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }
}
