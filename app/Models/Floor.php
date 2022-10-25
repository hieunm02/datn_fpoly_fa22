<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'building_id'
    ];
    public function buildings() {
        return $this->hasMany(Building::class, 'building_id', 'id');
    }
    public function rooms() {
        return $this->hasMany(Room::class, 'id', 'room_id');
    }
}
