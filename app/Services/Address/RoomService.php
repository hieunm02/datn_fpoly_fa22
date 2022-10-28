<?php

namespace App\Services\Address;

use App\Models\Room;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RoomService
{

    public function getRooms($id)
    {
        return Room::with(['building', 'floor'])->where('floor_id', $id)->paginate(6);
    }

    public function getRoom($id)
    {
        return Room::with(['building', 'floor'])->where('floor_id', $id)->first();
    }

    public function create($request)
    {
        try {
            $room = new Room($request->all());
            $room->active = 0;
            $room->save();

            Session::flash('success', 'Thêm dữ liêu thành công.');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return false;
        }
    }

    public function update($request, $id)
    {
        try {
            $room = Room::find($id);
            $room->fill($request->all());
            $room->save();

            Session::flash('success', 'Sửa dữ liêu thành công.');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        Room::find($id)->delete();
        Session::flash('success', 'Xóa dữ liệu thành công');
    }
}