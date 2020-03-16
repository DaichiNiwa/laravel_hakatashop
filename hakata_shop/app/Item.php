<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'price', 'image', 'stock', 'status'
    ];

    public function carts() {
        return $this->hasMany('App\cart');
    }
}
