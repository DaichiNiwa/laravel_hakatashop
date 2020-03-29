<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Cart;
use App\Item;
use App\User;
use App\History;
use App\HistoryDetail;
use App\Services\PurchaseService;

class HistoriesController extends Controller
{
    public function __construct(PurchaseService $purchase) {
        $this->purchase = $purchase;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('histories');
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $user = \Auth::user();

        // 売り切れ、非公開の商品ががあれば
        // カートに戻りエラーメッセージを表示させる、
        if (!$this->purchase->check_carts($user)) {
            return redirect('/carts');
        }
        
        // 売り切れ、非公開の商品がなければ、購入完了として
        // 購入履歴の登録、購入詳細の登録、カートを削除、在庫数更新を行う。
        $history = $this->purchase->purchase_finish($user);

        return redirect('/finish')->with([
            'history_id' => $history->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        // dd($history->HistoryDetails()->get());

        // foreach($history->HistoryDetails()->get() as $history_details){
        //     dd($history_details->item);
        // };
        // // dd($history->HistoryDetails());
        return view('history_details')->with('history', $history);
    }
}
