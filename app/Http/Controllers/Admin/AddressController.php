<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FloorRequest;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use App\Services\Address\BuildingService;
use App\Services\Address\FloorServices;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    protected $buildingService;
    protected $floorService;

    public function __construct(
        BuildingService $buildingService,
        FloorServices $floorService,
    ) {
        $this->buildingService = $buildingService;
        $this->floorService = $floorService;
    }

    public function getBuildings()
    {
        $data['title'] = 'Quản lý tòa';
        $data['buildings'] = $this->buildingService->getBuildings();

        return view('admin.address.buildings', $data);
    }

    public function getFloorsBuilding(Request $request, $id)
    {
        $data['title'] = 'Quản lí địa chỉ';
        $data['floors'] = Floor::with(['building', 'rooms'])->where('building_id', $id)->paginate(6);
        $data['buildind_id'] = $id;

        return view('admin.address.floor.floors_of_buil', $data);
    }

    public function getRoomsFloor(Request $request, $id)
    {
        $data['title'] = 'Quản lí địa chỉ';
        $data['rooms'] = Room::with(['building', 'floor'])->where('floor_id', $id)->paginate(6);

        return view('admin.address..floor.room.rooms_of_floor', $data);
    }

    public function createFloor($id)
    {
        $data['title'] = 'Thêm tầng';
        $data['building'] = Building::where('id', $id)->first();

        return view('admin.address.floor.create', $data);
    }

    public function storeFloor(FloorRequest $request)
    {

        $this->floorService->create($request);

        return redirect()->route('building.floors', [$request->building_id]);
    }
}