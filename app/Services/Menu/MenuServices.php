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
    public function getMenuIndex()
    {
        return Menu::select('id', 'name', 'thumb', 'parent_id')
            ->orderByDesc('id')
            ->get();
    }

    public function getAll()
    {
        return Menu::select('id', 'name', 'thumb', 'parent_id', 'active')
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);
    }

    public function getMenus($request)
    {
        $text_search = $request->get('text_search');
        $active_search = $request->get('active_search');
        if ($text_search == null) {
            $text_search = '';
        }
        $query = Menu::select('id', 'name', 'thumb', 'parent_id', 'active')
            ->where('name', 'like', '%' . $text_search . '%');

        if ($active_search === '0' || $active_search === '1') {
            $query->where('active', $active_search);
        }

        return $query->orderBy('updated_at', 'DESC');
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

            notify()->success('Tạo danh mục thành công');
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

            notify()->success('Sửa danh mục thành công');
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
        notify()->success('Xóa danh mục thành công');
    }
}
