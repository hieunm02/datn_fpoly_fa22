<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->status == 200) {
            $users = $this->userService->getUsers($request)->get();
            return response()->json([
                'users' => $users,
            ]);
        } else {
            $users = $this->userService->getUsers($request)->paginate(5);
            return view('admin.users.index', [
                'title' => 'Danh sách người dùng',
                'users' => $users
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeActive(Request $request)
    {
        $user = User::find($request->user_id);
        if ($request->active == 1) {
            $user->active = 0;
            $value = $user->active;
            $btnActive = 'bi-unlock-fill';
            $btnRemove = 'bi-lock-fill';
            $color = 'green';
        } else {
            $user->active = 1;
            $value = $user->active;
            $btnActive = 'bi-unlock-fill';
            $btnActive = 'bi-lock-fill';
            $btnRemove = 'bi-unlock-fill';
            $color = 'red';
        }
        $user->save();
        return response()->json([
            'btnActive' => $btnActive,
            'btnRemove' => $btnRemove,
            'value' => $value,
            'color' => $color,
        ]);
    }
}