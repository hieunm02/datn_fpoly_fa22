<?php

namespace App\Services\Address;

use App\Models\Floor;
use App\Models\Room;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class FloorServices
{

    public function getFloors()
    {
        return Floor::with(['building', 'rooms'])->paginate(6);
    }


    public function create($request)
    {
        try {
            $floor = new Floor();
            $floor->name = $request->name_floor_hd;
            $floor->building_id = $request->building_id;
            $floor->active = 0;
            $floor->save();
            if ($request->name_room) {
                $floor_id = $floor->id;
                foreach ($request->name_room as $room) {
                    if ($room) {
                        Room::create([
                            'name' => $room,
                            'building_id' => $request->building_id,
                            'floor_id' => $floor_id,
                            'active' => 0
                        ]);
                    }
                }
            }

            notify()->success('Thêm dữ liệu thành công.');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
            Log::info($th->getMessage());
            return false;
        }
    }
}
