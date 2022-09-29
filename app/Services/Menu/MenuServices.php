<?php

namespace App\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class MenuServices 
{
    public function getParent(){
        return Menu::where('parent_id', 0)->get();
    }
    
    public function getAll()
    {
        return Menu::select('id', 'name', 'thumb', 'parent_id', 'active')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function create($request){
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'thumb' => (string) $request->input('thumb'),
                'active' => (string) $request->input('active'),
            ]);

            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }
} 
