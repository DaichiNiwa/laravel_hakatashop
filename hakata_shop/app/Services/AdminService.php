<?php 
namespace App\Services;

class AdminService {
  public function is_admin($user) {
    if($user->is_admin() === false) {
      session()->flash('modal_msg', '不正なアクセスが行われました。');
      return false;
    }
    return true;
  }

  public function save_image($request) {
    $filename = '';
    $image = $request->file('image');
    if(isset($image) === true) {
        // 拡張子を取得
        $ext = $image->guessExtension();
        // アップロードファイル名は[ランダム文字列20文字].[拡張子]
        $filename = str_random(20) . ".{$ext}";
        // publicディスク(storage/app/public/)のphotosディレクトリに保存
        $path = $image->storeAs('photos', $filename, 'public'); 
    }
    return $filename;
  }
}