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
        return News::select('id', 'title', 'user_id', 'image_path', 'active')
            ->orderByDesc('updated_at', 'DESC')
            ->paginate(5);
    }

    public function getNews($request)
    {
        $text_search = $request->get('text_search');
        $active_search = $request->get('active_search');
        if ($text_search == null) {
            $text_search = '';
        }
        $query = News::select('id', 'title', 'user_id', 'image_path', 'active')
            ->where('title', 'like', '%' . $text_search . '%');

        if ($active_search === '0' || $active_search === '1') {
            $query->where('active', $active_search);
        }

        return $query->orderBy('updated_at', 'DESC');
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

            notify()->success('Tạo thành công');
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
            notify()->success('Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }
}
