<?php 
namespace App\Services;

use DB;
use App\History;
use App\HistoryDetail;

class PurchaseService {

  public function delete_cart($cart) {
    $cart->delete();
    session()->flash('modal_msg', '削除が完了しました。');
  }
  
  public function check_carts($user) {
    $is_success = true;
    $error_msgs = [];

    if(count($user->carts) === 0) {
      $error_msgs[] = 'カートに商品がありません。';
      $is_success = false;
    }
    
    foreach($user->carts as $cart) {
      $is_success = true;
      // 在庫がない、足りない、または非公開になった商品があればエラーメッセージを表示する
      if($cart->item->stock === 0) {
        $error_msgs[] = $cart->item->name . 'は売れ切れになっています。';
        $is_success = false;
      }

      if($cart->item->stock < $cart->amount) {
        $error_msgs[] = $cart->item->name . 'の在庫が足りません。';
        $is_success = false;
      }

      if($cart->item->status === 0) {
        $error_msgs[] = $cart->item->name . 'は現在購入できません。';
        $is_success = false;
      }
    }
    session()->flash('error_msgs', $error_msgs);
    return $is_success;
  }

  public function purchase_finish($user) {
    return DB::transaction(function () use ($user) {
      // 購入履歴の登録
      $history = new History([
        'user_id' => $user->id,
      ]);
      $history->save();

      foreach($user->carts as $cart) {
          // 購入詳細の登録
          $historyDetail = new HistoryDetail([
              'history_id' => $history->id,
              'item_id' => $cart->item->id,
              'purchased_price' => $cart->item->price,
              'amount' => $cart->amount,
          ]);
          $historyDetail->save();
          // カートを削除
          $cart->delete();
          // 在庫数更新
          $cart->item->stock -= $cart->amount;
          $cart->item->save();
      }
      return $history;
    });
  }
}