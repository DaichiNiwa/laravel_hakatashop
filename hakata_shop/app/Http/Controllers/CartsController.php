<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Item;
use App\User;
use App\Services\PurchaseService;

class CartsController extends Controller
{
    public function __construct(PurchaseService $purchase) {
        $this->purchase = $purchase;
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = \Auth::user();
        // 売り切れや非公開の商品があれば、エラーメッセージを表示させる
        $this->purchase->check_carts($user);

        return view('carts')->with(
            compact('user')
            // ['user' => $user,]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Item $item)
    {
        
        $user = \Auth::user();
        // すでに同じ商品がカートにあるか確かめ、あるなら個数を追加する
        // existsメソッドならCart::where('user_id', $user->id)->exist();で戻り値bool
        $same_cart = Cart::where('user_id', $user->id)
            ->where('item_id', $item->id)
            ->first();
        if(isset($same_cart)) {
            $same_cart->amount += $request->amount;

            $same_cart->save();
        } else {
            // 同じ商品がカートにないなら、新しく追加する
            // user_idはあとから修正
            $cart = new Cart([
                'user_id' => $user->id,
                'item_id' => $item->id,
                'amount' => $request->amount,
            ]);
            $cart->save();
        }
        return redirect('/carts');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        // 数量が0に変更された場合、そのカートを削除
        if($request->amount === '0') {
            $this->purchase->delete_cart($cart);
            return redirect()->back();
        }
        
        $cart->amount = $request->amount;
        $cart->save();
        session()->flash('modal_msg', '数量変更が完了しました。');
        return redirect('/carts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $this->purchase->delete_cart($cart);
        return redirect()->back();
    }
}
