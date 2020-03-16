<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    
    public function item() {
        return $this->belongsTo('App\Item');
    }
    
    public function cart_sum() {
        return $this->item->price * $this->amount;
    }
    
    protected $fillable = [
        'user_id', 'item_id', 'amount',
    ];
}
