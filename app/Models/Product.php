<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected  $fillable = ['name', 'thumb', 'content', 'menu_id', 'price', 'price_sales', 'active', 'desc', 'quantity'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function scopeFilter($query)
    {

        if (request('price_low_high') == 0) {
            $query->orderBy('price', 'asc');
        } else {
            $query->orderBy('price', 'desc');
        }

        if (request('price_from') && request('price_to')) {
            if (request('price_from') > request('price_to')) {
                $query->whereBetween('price', [request('price_to'), request('price_from')]);
            } elseif (request('price_from') == request('price_to')) {
                $query->where('price', request('price_from'));
            } else {
                $query->whereBetween('price', [request('price_from'), request('price_to')]);
            }
        }

        return $query;
    }
    public function order()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
