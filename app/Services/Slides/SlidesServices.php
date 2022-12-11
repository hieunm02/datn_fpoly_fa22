<?php

namespace App\Services\Slides;

use App\Models\Product;
use App\Models\Slide;
use Illuminate\Support\Facades\Session;

class SlidesServices
{
    public function getListSlides()
    {
        return Slide::with('product')
            ->select('id', 'name', 'product_id', 'thumb', 'active')
            ->orderBy('id', 'DESC')->paginate(5);;
    }

    public function getSlides($request)
    {
        $text_search = $request->get('text_search');
        $active_search = $request->get('active_search');
        if ($text_search == null) {
            $text_search = '';
        }
        $query = Slide::with('product')
            ->where('name', 'like', '%' . $text_search . '%');

        if ($active_search === '0' || $active_search === '1') {
            $query->where('active', $active_search);
        }

        return $query->orderBy('updated_at', 'DESC');
    }

    public function getProducts()
    {
        return Product::all();
    }

    public function createSlide($request)
    {

        try {
            $slide = new Slide($request->all());
            if ($request->hasFile('thumb')) {
                $image = $request->thumb;
                $imageName = $image->hashName();
                $imageName = $request->name . '_' . $imageName;
                $slide->thumb = $image->storeAs('images/slides', $imageName);
            }
            dd($slide);
            $slide->save();
            notify()->success('Tạo mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function updateSlide($request, $id)
    {
        try {
            $slide = Slide::find($id);
            $slide->fill($request->all());
            if ($request->hasFile('thumb')) {
                $image = $request->thumb;
                $imageName = $image->hashName();
                $imageName = $request->name . '_' . $imageName;
                $slide->thumb = $image->storeAs('images/slides', $imageName);
            }
            $slide->save();
            notify()->success('Sửa thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function delete($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        notify()->success('Xóa thành công.');
    }
}
