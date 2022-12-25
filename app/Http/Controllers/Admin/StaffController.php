<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditStaffRequest;
use App\Http\Requests\StaffRequest;
use App\Models\Notify;
use App\Models\User;
use App\Services\Staffs\StaffServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
    public function index(Request $request)
    {
        if ($request->status == 200) {
            $staffs = $this->staffServices->getstaffs($request)->get();
            return response()->json([
                'staffs' => $staffs,
            ]);
        } else {
            $staffs = $this->staffServices->getstaffs($request)->paginate(5);
            return view('admin.staffs.index', [
                'title' => 'Danh sách nhân viên',
                'staffs' => $staffs
            ]);
        }
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
    public function update(EditStaffRequest $request, $id)
    {
        // dd($request->all());
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
        Notify::whereIn('user_id', [$staff->id])->delete();
        $staff->delete();
        Session::flash('success', 'Xóa thành công');

        return response()->json(['model' => $staff]);
    }

    public function changeActive(Request $request)
    {
        $staff = User::find($request->staff_id);
        if ($request->active == 1) {
            $staff->active = 0;
            $value = $staff->active;
            $btnActive = 'bi-unlock-fill';
            $btnRemove = 'bi-lock-fill';
            $color = 'green';
        } else {
            $staff->active = 1;
            $value = $staff->active;
            $btnActive = 'bi-lock-fill';
            $btnRemove = 'bi-unlock-fill';
            $color = 'red';
        }
        $staff->save();
        return response()->json([
            'btnActive' => $btnActive,
            'btnRemove' => $btnRemove,
            'value' => $value,
            'color' => $color,
        ]);
    }
}
