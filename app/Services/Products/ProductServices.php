<?php

namespace App\Services\Products;

use App\Models\Menu;
use App\Models\Price;
use App\Models\Product;
use App\Models\Thumb;
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

    public function getAll()
    {
        return Product::with('menu', 'price')->select('id', 'name', 'menu_id', 'thumb', 'active')
            ->orderByDesc('id')->paginate(5);
    }

    public function create($request)
    {

        try {
            $product = new Product();
            $product->fill($request->all());
            if ($request->hasFile('thumb')) {
                $image = $request->thumb;
                $imageName = $image->hashName();
                $imageName = $request->name . '_' . $imageName;
                $product->thumb = $image->storeAs('images/products', $imageName);
                $product->content = $request->content;
                $product->desc = $request->desc;
                $product->quantity = $request->quantity;
                $product->name = $request->name;
                $product->price_id = $request->price_id;
                $product->menu_id = $request->menu_id;
                $product->active = 1;
                $product->save();
            }
            $productId = $product->id;
            if ($request->hasFile('image')) {
                foreach ($request->image as $file) {
                    $imageNew = new Thumb();
                    if (isset($file)) {
                        $imageNew->image = $file->hashName();
                        $imageNew->product_id = $productId;
                        $file->move('images/products', $file->hashName());
                        $imageNew->save();
                    }
                }
            }

            Session::flash('success', 'Tạo sản phẩm  thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function update($data)
    {

    }
}
