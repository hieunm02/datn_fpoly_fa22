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
            ->select('id', 'name', 'product_id', 'url', 'thumb', 'sort_by', 'active')
            ->orderBy('id', 'ASC')->paginate(5);;
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
            $slide->save();
            Session::flash('success', 'Tạo mới thành công');
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
            Session::flash('success', 'Sửa thành công');
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
        Session::flash('success', 'Xóa thành công.');
    }
}