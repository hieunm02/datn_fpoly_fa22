<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Services\News\NewsServices;

class ClientNewsController extends Controller
{
    public function __construct(NewsServices $newsServices)
    {
        $this->newsServices = $newsServices;
    }

    public function index()
    {
        $news = $this->newsServices->getAlls();
        // $authors = User::select('id', 'name')->get();
        $title = "Danh sách bài viết";
        // dd($news);
        return view('client.news', compact('news', 'title'));
    }

    public function show($id)
    {
        $news = News::find($id);
        $newsAll = $this->newsServices->getAll();
        $title = "Chi tiet bài viết";

        return view('client.news-detail', compact('news', 'newsAll', 'title'));
    }
}
