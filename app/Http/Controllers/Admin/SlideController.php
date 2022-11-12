<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SlidesRequest;
use App\Models\Slide;
use App\Services\Slides\SlidesServices;
use Illuminate\Http\Request;

class SlideController extends Controller
{

    protected $slideServices;

    public function __construct(SlidesServices $slideServices)
    {
        $this->slideServices = $slideServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Danh sách slides';
        $data['slides'] = $this->slideServices->getListSlides();

        return view('admin.slides.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Thêm slide';
        $data['products'] = $this->slideServices->getProducts();

        return view('admin.slides.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlidesRequest $request)
    {

        if (!$request->hasFile('thumb')) {
            return back()->with('thumb_error', 'Ảnh không được để trống.');
        }

        $this->slideServices->createSlide($request);
        return redirect()->route('slides.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Sửa slide';
        $data['products'] = $this->slideServices->getProducts();
        $data['slide'] = Slide::find($id);

        return view('admin.slides.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->slideServices->updateSlide($request, $id);
        return redirect()->route('slides.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        return response()->json(['model' => $slide]);
    }

    public function changeActive(Request $request)
    {
        $slide = Slide::find($request->slide_id);
        if ($request->active == 1) {
            $slide->active = 2;
            $value = $slide->active;
            $title = 'Deactive';
            $btnActive = 'badge-danger';
            $btnRemove = 'badge-success';
        } else {
            $slide->active = 1;
            $value = $slide->active;
            $title = 'Actived';
            $btnActive = 'badge-success';
            $btnRemove = 'badge-danger';
        }
        $slide->save();
        return response()->json([
            'title' => $title,
            'btnActive' => $btnActive,
            'btnRemove' => $btnRemove,
            'value' => $value,
        ]);
    }
}