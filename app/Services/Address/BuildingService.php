<?php

namespace App\Services\Address;

use App\Models\Building;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BuildingService
{

    public function getBuildings()
    {
        return Building::with(['floors', 'rooms'])->paginate(6);
    }
}