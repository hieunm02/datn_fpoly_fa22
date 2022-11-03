<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Services\Menu\MenuServices;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuServices $menuService)
    {
        $this->menuService = $menuService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = $this->menuService->getAll();
        return view('admin.menus.index', [
            'title' => 'Danh sách danh mục',
            'menus' => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_parent = $this->menuService->getParent();
        return view('admin.menus.create', [
            'title' => 'Thêm mới menu',
            'menus' => $menu_parent,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menu_parent = $this->menuService->getParent();
        $this->menuService->create($request);
        return redirect()->route('menus.index', [
            'title' => 'Thêm mới menu',
            'menus' => $menu_parent,
        ]);
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
        $menu_parent = $this->menuService->getParent();
        $data = $this->menuService->getId($id);
        // \dd($data);
        return view('admin.menus.edit', [
            'title' => 'Sửa menu',
            'menus' => $menu_parent,
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        $this->menuService->update($request, $id);
        return redirect()->route('menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //    echo "xoa";
        $menu = $this->menuService->getId($id);
        $this->menuService->destroyId($id);
        return response()->json(['model' => $menu]);
    }
}
