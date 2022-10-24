<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name'
    ];

    public function floors() {
        return $this->hasMany(Floor::class, 'id', 'building_id');
    }
    public function rooms() {
        return $this->hasMany(Room::class, 'id', 'building_id');
    }
}
