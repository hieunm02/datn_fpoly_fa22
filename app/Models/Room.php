<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'building_id',
        'floor_id',
        'active'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }
}