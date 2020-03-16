<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryDetail extends Model
{
    public function item() {
        return $this->belongsTo('App\Item');
    }

    public function history_detail_sum() {
        return $this->purchased_price * $this->amount;
    }

    protected $fillable = [
        'history_id', 'item_id', 'purchased_price', 'amount',
    ];
}

