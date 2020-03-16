<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{

    public function HistoryDetails() {
        return $this->hasMany('App\HistoryDetail');
    }

    public function history_details_sum() {
        return $this->HistoryDetails->sum(function($history_detail) {
            return $history_detail->history_detail_sum();
        });
    }

    protected $fillable = [
        'user_id', 
    ];
}