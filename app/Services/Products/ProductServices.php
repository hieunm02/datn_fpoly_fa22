<?php

namespace App\Services\Products;

use App\Models\Menu;
use App\Models\Price;
use App\Models\Product;
use App\Models\Thumb;
use Illuminate\Support\Facades\Session;
use Response;

class ProductServices
{
    public function getMenu()
    {
        return Menu::where('active', 0)->get();
    }

    public function getPrice()
    {
        return Price::all();
    }

    public function getById($id)
    {
        return Product::find($id);
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

    public function getProducts($request)
    {
        $text_search = $request->get('text_search');
        if ($text_search == null) {
            $text_search = '';
        }
        return  Product::with('menu')
            ->select('id', 'name', 'menu_id', 'price', 'price_sales', 'quantity', 'thumb', 'active')
            ->where('name', 'like', '%' . $text_search . '%')
            ->orderBy('updated_at', 'DESC')->paginate(5);
    }

    public function getAll()
    {
        return  Product::with('menu')
            ->select('id', 'name', 'menu_id', 'price', 'price_sales', 'quantity', 'thumb', 'active')
            ->orderBy('id', 'DESC')->paginate(5);
    }

    public function create($request)
    {
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
            $product->price_sales = filter_var($request->price_sales, FILTER_SANITIZE_NUMBER_INT);
            $product->price = filter_var($request->price, FILTER_SANITIZE_NUMBER_INT);
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
        notify()->success('Tạo mới thành công');

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
                        // $imageNew = $file->storeAs('images/products', $imageNew);
                        // $file->move('images/imagedetails', $file->hashName());
                        $imageNew->save();
                    }
                }
            }
            notify()->success('Cập nhật thành công');
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