<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = Notify::orderBy('created_at', 'DESC')->paginate(5);
        $title = 'Danh sách thông báo';
        $notifies = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $pending = $result->status == "pending" ? "pending" : '';
                if ($result->type == "message") {
                    $notifies .= '
                        <div class="notif_card ' . $pending . ' notify" data-id="' . $result->id . '">
                            <div class="avatar avatar-volcano avatar-icon">
                                <i class="anticon anticon-message"></i>
                            </div>
                            <div class="description">
                                <a href="/admin/chats/message/' . $result->user_id . '" class="user_activity">
                                    Tin nhắn mới từ <strong class="m-b-0 text-dark font-weight-semibold">' . $result->user->name . '</strong> 
                                </a>
                                <p class="time">' . $result->created_at->diffForHumans() . '</p>
                            </div>
                        </div>
                        ';
                } elseif ($result->type == "contact") {
                    $notifies .= '
                    <div class="notif_card ' . $pending . ' notify" data-id="' . $result->id . '">
                        <div class="avatar avatar-blue avatar-icon">
                            <i class="anticon anticon-mail"></i>
                        </div>
                        <div class="description">
                            <a href="/admin/contacts" class="user_activity">
                            Liên hệ mới từ <strong class="m-b-0 text-dark font-weight-semibold">' . $result->user->name . '</strong> 
                            </a>
                            <p class="time">' . $result->created_at->diffForHumans() . '</p>
                        </div>
                    </div>
                    ';
                } elseif ($result->type == "order") {
                    $notifies .= '
                    <div class="notif_card ' . $pending . ' notify" data-id="' . $result->id . '">
                        <div class="avatar avatar-cyan avatar-icon">
                            <i class="anticon anticon-shopping-cart"></i>
                        </div>
                        <div class="description">
                            <a href="/admin/orders" class="user_activity">
                            Đơn hàng mới từ <strong class="m-b-0 text-dark font-weight-semibold">' . $result->user->name . '</strong> 
                            </a>
                            <p class="time">' . $result->created_at->diffForHumans() . '</p>
                        </div>
                    </div>
                    ';
                } elseif ($result->type == "comment") {
                    $notifies .= '
<div class="notif_card ' . $pending . ' notify" data-id="' . $result->id . '">
                        <div class="avatar avatar-gold avatar-icon">
                            <i class="far fa-comment-alt"></i>                                               
                        </div>
                        <div class="description">
                            <a href="/admin/comments" class="user_activity">
                                <strong class="m-b-0 text-dark font-weight-semibold">' . $result->user->name . '</strong> đã bình luận
                            </a>
                            <p class="time">' . $result->created_at->diffForHumans() . '</p>
                        </div>
                    </div>
                    ';
                }
            }
            return $notifies;
        }
        return view('admin.notifies.index', compact('title'));
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
        $notify = Notify::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'room_id' => $request->room_id,
        ]);

        return response()->json(['notify' => $notify]);
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
        $notify = Notify::find($request->notify_id);
        $notify->status = 'read';
        $notify->save();
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
}
