<?php

namespace App\Http\Controllers;

use App\History;
use App\Services\PurchaseService;

class ProcessController extends Controller
{
    public function __construct(PurchaseService $purchase) {
        $this->purchase = $purchase;
        $this->middleware('auth');
    }

    // 購入完了時の遷移
    public function finish()
    {
        // session('history_id')があるか確かめる
        if(session()->has('history_id') === false) {
            session()->flash('modal_msg', '不正なリクエストが行われました。');
            return redirect('/carts');
        }
        $history = History::find(session('history_id'));
        return view('finish')->with([
            'history' => $history ]);
    }
}
