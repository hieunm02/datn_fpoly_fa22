<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'active'
    ];

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}