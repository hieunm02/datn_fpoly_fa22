<?php

namespace App\Services\Products;

use App\Models\Menu;
use App\Models\Price;
use App\Models\Product;
use App\Models\Thumb;
use Illuminate\Support\Facades\Log;
use Response;
use Illuminate\Support\Facades\Session;

class ProductServices
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    public function getPrice()
    {
        return Price::all();
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    protected function isValidPrice($request)
    {
        if (
            $request->price != 0 &&
            $request->price_sales != 0 &&
            $request->price_sales >= $request->price
        ) {
            Session::flash('price_sales', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        if ($request->price_sales != 0 && $request->price == 0) {
            Session::flash('price_sales', 'Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }

    public function getThumbByProduct($productId)
    {
        $thumbnails = Thumb::where('product_id', $productId)->get();
        $nameThumbs = [];
        foreach ($thumbnails as $thumb) {
            $nameThumbs[] = $thumb->image;
        }
        return json_encode($nameThumbs);
    }

    public function getAll()
    {

        return Product::with('menu', 'price')
            ->select('id', 'name', 'menu_id', 'price', 'price_sales', 'quantity', 'thumb', 'active')
            ->orderBy('id', 'DESC')->paginate(5);
    }

    public function create($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice == false)
            return false;
        try {
            $product = new Product();
            $product->fill($request->all());
            if ($request->hasFile('thumb')) {
                $image = $request->thumb;
                $imageName = $image->hashName();
                $imageName = $request->name . '_' . $imageName;
                $product->thumb = $image->storeAs('images/products/avartars', $imageName);
                $product->content = $request->content;
                $product->desc = $request->desc;
                $product->quantity = $request->quantity;
                $product->name = $request->name;
                $product->menu_id = $request->menu_id;
                $product->active = 1;
                $product->save();
            }
            $productId = $product->id;
            if ($request->hasFile('image')) {
                foreach ($request->image as $file) {
                    $imageNew = new Thumb();
                    if (isset($file)) {
                        $imageNew->image = $file->storeAs('images/products/details', $file->hashName());
                        $imageNew->product_id = $productId;
                        // $imageNew = $file->storeAs('images/products', $imageNew);
                        // $file->move('images/imagedetails', $file->hashName());
                        $imageNew->save();
                    }
                }
            }
            Session::flash('success', 'Tạo mới thành công');
        } catch (\Exception $err) {
            dd('ba');
            Session::flash('error', 'Không thể thêm mới sản phẩm');
            Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $id)
    {
        try {
            $product = $this->getById($id);
            $product->fill($request->all());
            if ($request->hasFile('thumb')) {
                $image = $request->thumb;
                $imageName = $image->hashName();
                $imageName = $request->name . '_' . $imageName;
                $product->thumb = $image->storeAs('images/products/avartars', $imageName);
            }
            $product->save();
            $productId = $product->id;
            //
            $this->removeThumbsUpdate($id);
            //
            $this->keepThumbsUpdate($request, $id);

            if ($request->hasFile('image')) {
                foreach ($request->image as $file) {
                    $imageNew = new Thumb();
                    if (isset($file)) {
                        $imageNew->image = $file->storeAs('images/products/details', $file->hashName());
                        $imageNew->product_id = $productId;
                        $imageNew->save();
                    }
                }
            }
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();
            Session::flash('success', 'Xóa sản phẩm thành công.');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return false;
        }

        return true;
    }

    public function removeThumbsUpdate($id)
    {
        $productThumbs = Thumb::where('product_id', $id)->get();
        if ($productThumbs) {
            foreach ($productThumbs as $thumb) {
                $thumb->delete();
            }
        }
    }

    public function keepThumbsUpdate($request, $id)
    {
        $thumbsUpdate = $request->image_update;
        if ($thumbsUpdate) {
            $arr = explode(',', $thumbsUpdate);
            foreach ($arr as $thumb) {
                $thumbs = new Thumb();
                $thumbs->image = $thumb;
                $thumbs->product_id = $id;
                $thumbs->save();
            }
        }
    }
}