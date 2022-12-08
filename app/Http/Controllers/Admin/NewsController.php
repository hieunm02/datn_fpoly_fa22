<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Services\News\NewsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;
use PhpParser\Node\Expr\AssignOp\Mod;

class NewsController extends Controller
{
    protected $newsServices;
    public function __construct(NewsServices $newsServices)
    {
        $this->newsServices = $newsServices;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->status == 200) {
            $news = $this->newsServices->getNews($request)->get();
            return response()->json([
                'news' => $news,
            ]);
        } else {
            $news = $this->newsServices->getNews($request)->paginate(5);
            return view('admin.news.index', [
                'title' => 'Danh sách bài viết',
                'news' => $news
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
        $title = 'Thêm mới bài viết';
        return view('admin.news.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $this->newsServices->create($request);
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        if (!Cookie::get('ddd')) {
            $cookie = cookie('ddd', $news->id, '1', 1);
            return response()->view('admin.news.test', compact('news'))->withCookie($cookie);
        }

        return view('admin.news.test', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Cập nhật bài viết';
        $news = News::find($id);
        return view('admin.news.edit', compact('news', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $news = News::find($id);
        if (!$request['image_path']) {
            $request['image_path'] = $news['image_path'];
        }
        $this->newsServices->update($request, $id);
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return response()->json(['model' => $news]);
    }

    public function changeActive(Request $request)
    {
        $new = News::find($request->new_id);
        if ($request->active == 1) {
            $new->active = 0;
            $value = $new->active;
            $btnActive = 'bi-unlock-fill';
            $btnRemove = 'bi-lock-fill';
            $color = 'green';
        } else {
            $new->active = 1;
            $value = $new->active;
            $btnActive = 'bi-lock-fill';
            $btnRemove = 'bi-unlock-fill';
            $color = 'red';
        }
        $new->save();
        return response()->json([
            'btnActive' => $btnActive,
            'btnRemove' => $btnRemove,
            'value' => $value,
            'color' => $color,
        ]);
    }
}
