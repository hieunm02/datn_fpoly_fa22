<?php

namespace App\Services\Address;

use App\Models\Building;
use App\Models\Floor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BuildingService
{

    public function getBuildings()
    {
        return Building::with(['floors', 'rooms'])->paginate(6);
    }

    public function create($request)
    {
        try {
            Building::create([
                'name' => $request->name,
                'active' => 0,
            ]);

            Session::flash('success', 'Thêm thành công.');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            Log::info($th->getMessage());
            return false;
        }
    }

    public function update($request, $id)
    {
        try {
            $building = Building::find($id);
            $building->update($request->all());
            Session::flash('success', ' Cập nhật dữ liệu thành công.');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $building = Building::find($id);
            $building->delete();
            Session::flash('success', ' Xóa dữ liệu thành công.');
        } catch (\Throwable $th) {
            return false;
        }
    }
}