<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
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
    public function index()
    {
        // Role::create(['name' => 'manager']);
        // Role::create(['name' => 'staff']);
        // Role::create(['name' => 'customer']);

        // Permission::create(['name' => 'Create contact']);
        // Permission::create(['name' => 'View contact']);
        // Permission::create(['name' => 'Edit contact']);
        // Permission::create(['name' => 'Delete contact']);

        // Permission::create(['name' => 'Create slide']);
        // Permission::create(['name' => 'View slide']);
        // Permission::create(['name' => 'Edit slide']);
        // Permission::create(['name' => 'Delete slide']);

        // Permission::create(['name' => 'Create news']);
        // Permission::create(['name' => 'View news']);
        // Permission::create(['name' => 'Edit news']);
        // Permission::create(['name' => 'Delete news']);

        // Permission::create(['name' => 'View bill']);

        // Permission::create(['name' => 'Create product']);
        // Permission::create(['name' => 'View product']);
        // Permission::create(['name' => 'Edit product']);
        // Permission::create(['name' => 'Delete product']);

        // Permission::create(['name' => 'Create menu']);
        // Permission::create(['name' => 'View menu']);
        // Permission::create(['name' => 'Edit menu']);
        // Permission::create(['name' => 'Delete menu']);

        // Permission::create(['name' => 'Create staff']);
        // Permission::create(['name' => 'View staff']);
        // Permission::create(['name' => 'Edit staff']);
        // Permission::create(['name' => 'Delete staff']);

        // Permission::create(['name' => 'Create comment']);
        // Permission::create(['name' => 'View comment']);
        // Permission::create(['name' => 'Edit comment']);
        // Permission::create(['name' => 'Delete comment']);

        // Permission::create(['name' => 'View statistic']);

        // $role = Role::findById(2);
        // // // $per = Permission::all();
        // // // $role->givePermissionTo($per);
        // $user = User::find(2);
        // $user->assignRole($role);

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
        if ($staff->role === 1) {
            $staff->delete();
        }
        Session::flash('success', 'Xóa thành công');

        return response()->json(['model' => $staff]);
    }
}
