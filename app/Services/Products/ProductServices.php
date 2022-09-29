<?php

namespace App\Services\Products;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductServices
{
    public function getParrent()
    {
        return Menu::where('active', 1)->get();
    }

    public function getAll()
    {
        return Product::with('menu')->select('id', 'name', 'menu_id', 'thumb', 'active')
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
//                $product->content = $request->content;
//                $product->name = $request->name;
//                $product->price_id = $request->price_id;
//                $product->menu_id = $request->menu_id;
//                $product->active = $request->active;
                $product->save();
            }

            $productId = $product->id;
//            if ($request->hasFile('thumb')) {
//                foreach ($request->thumb as $file) {
//                    $imageNew = new Thumb();
//                    if (isset($file)) {
//                        $imageNew->gallery = $file->hashName();
//                        $imageNew->product_id = $productId;
//                        // $imageNew = $file->storeAs('images/products', $imageNew);
//                        $file->move('images/products', $file->hashName());
//                        $imageNew->save();
//                    }
//                }
//            }
            Session::flash('success', 'Tạo mới thành công');
            return redirect()->route('products.index');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }
    public function update($data){

    }
}
