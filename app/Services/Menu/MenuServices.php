<?php

namespace App\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;

class MenuServices
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll()
    {
        return Menu::select('id', 'name', 'thumb', 'parent_id', 'active')
            ->orderByDesc('id')
            ->paginate(5);
    }

    public function create($request)
    {
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

    public function update($request, $id)
    {
        try {
            $data = Menu::find($id);
            // dd($data);
            $data->name = (string) $request->input('name');
            $data->parent_id = (int) $request->input('parent_id');
            $data->thumb = (string) $request->input('thumb');
            $data->active = (string) $request->input('active');
            $data->save();
            // Menu::create([
            //     'name' => (string) $request->input('name'),
            //     'parent_id' => (int) $request->input('parent_id'),
            //     'thumb' => (string) $request->input('thumb'),
            //     'active' => (string) $request->input('active'),
            // ]);

            Session::flash('success', 'Sửa danh mục thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function getId($id)
    {
        return Menu::find($id);
    }

    public function destroyId($id)
    {
        // dd($id);
        $data = Menu::find($id);
        $data->delete();
        Session::flash('success', 'Xóa danh mục thành công');
    }
}
