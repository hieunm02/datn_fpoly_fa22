<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'original',
        'sale'
    ];
}
=======
    protected $table = 'prices';

    protected $fillable = [
        'original',
        'sales'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
>>>>>>> dev
