<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuildingRequest;
use App\Http\Requests\FloorRequest;
use App\Http\Requests\RoomRequest;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use App\Services\Address\BuildingService;
use App\Services\Address\FloorServices;
use App\Services\Address\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AddressController extends Controller
{

    protected $buildingService;
    protected $floorService;
    protected $roomService;

    public function __construct(
        BuildingService $buildingService,
        FloorServices $floorService,
        RoomService $roomService,
    ) {
        $this->buildingService = $buildingService;
        $this->floorService = $floorService;
        $this->roomService = $roomService;
    }
    //Building 
    public function getBuildings()
    {
        $data['title'] = 'Quản lý tòa';
        $data['buildings'] = $this->buildingService->getBuildings();

        return view('admin.address.buildings', $data);
    }
    //create
    public function createBuilding()
    {
        $data['title'] = 'Thêm tòa';

        return view('admin.address.create_building', $data);
    }

    public function storeBuilding(BuildingRequest $request)
    {
        $this->buildingService->create($request);

        return redirect()->route('building.index');
    }

    //edit
    public function editBuilding($id)
    {
        $data['title'] = 'Sửa tòa';
        $data['building'] = Building::find($id);

        return view('admin.address.update_building', $data);
    }

    public function updateBuilding(BuildingRequest $request, $id)
    {
        $this->buildingService->update($request, $id);

        return redirect()->route('building.index');
    }


    //delete
    public function destroyBuilding($id)
    {
        $this->buildingService->delete($id);

        return back();
    }
    //floor
    public function getFloorsBuilding($id)
    {
        $data['title'] = 'Quản lí tầng';
        $data['floors'] = Floor::with(['building', 'rooms'])->where('building_id', $id)->paginate(6);
        $data['buildind_id'] = $id;

        return view('admin.address.floor.floors_of_buil', $data);
    }

    //validate unique

    public function uniqueFloor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('floors')->ignore($request->id),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        return response()->json(['success' => 'OK']);
    }

    //create 
    public function createFloor($id)
    {
        $data['title'] = 'Thêm tầng';
        $data['building'] = Building::where('id', $id)->first();

        return view('admin.address.floor.create_floor', $data);
    }

    public function storeFloor(Request $request)
    {

        $this->floorService->create($request);

        return redirect()->route('building.floors', [$request->building_id]);
    }

    //edit

    public function editFloor($id)
    {
        $data['title'] = 'Sửa tầng';
        $data['floor'] = Floor::find($id);

        return view('admin.address.floor.update_floor', $data);
    }

    public function updateFloor(FloorRequest $request, $id)
    {
        $this->floorService->update($request, $id);

        return redirect()->route('building.floors', [$request->building_id]);
    }

    public function destroyFloor($id)
    {
        $this->floorService->delete($id);

        return back();
    }

    //room
    public function getRoomsFloor(Request $request, $id)
    {
        $data['title'] = 'Quản lí phòng';
        $data['rooms'] = $this->roomService->getRooms($id);
        $data['room'] = $this->roomService->getRoom($id);

        return view('admin.address.floor.room.rooms_of_floor', $data);
    }

    public function createRoom($id)
    {
        $data['title'] = 'Thêm phòng';
        $data['floor'] = Floor::find($id);

        return view('admin.address.floor.room.create', $data);
    }

    public function storeRoom(RoomRequest $request)
    {
        $this->roomService->create($request);

        return redirect()->route('floor.rooms', [$request->floor_id]);
    }

    public function editRoom($id)
    {
        $data['title'] = 'Sửa phòng';
        $data['room'] = Room::find($id);

        return view('admin.address.floor.room.update', $data);
    }

    public function updateRoom(RoomRequest $request, $id)
    {
        $this->roomService->update($request, $id);

        return redirect()->route('floor.rooms', [$request->floor_id]);
    }

    public function destroy($id)
    {
        $this->roomService->delete($id);

        return back();
    }
}