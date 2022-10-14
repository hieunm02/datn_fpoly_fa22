<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\User;
use App\Services\Staffs\StaffServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    protected $staffServices;

    public function __construct(StaffServices $staffServices)
    {
        $this->staffServices = $staffServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = $this->staffServices->getStaff();
        $title = "Danh sách nhân viên";
        return view('admin.staffs.index', compact('staffs', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm nhân viên';
        return view('admin.staffs.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        // dd($request->all());
        // if ($request->hasFile('image_path'))

        $this->staffServices->create($request);
        return redirect()->route('staffs.index');
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
        $staff = $this->staffServices->findStaff($id);
        $title = "Chỉnh sửa thông tin nhân viên";
        return view('admin.staffs.edit', compact('staff', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StaffRequest $request, $id)
    {
        if ($request->hasFile('avatar')) {
            $image = $request->avatar;
            $imageName = $image->hashName();
            dd($request->imageName);
            $imageName = $request->name . '_' . $imageName;
            $request->avatar = $image->storeAs('images/slides', $imageName);
            dd($request->all());
        }

        $this->staffServices->update($request, $id);
        return redirect()->route('staffs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = User::find($id);
        if ($staff->role === 1) {
            $staff->delete();
        }
        Session::flash('success', 'Xóa thành công');

        return response()->json(['staff' => $staff]);
    }
}
