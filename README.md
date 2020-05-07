# 博多うまか市場 laravel_hakatashop
2019年11月制作  
laravelの学習のために制作した簡易的なショッピングサイトです。オンラインのプログラミングスクールで講師の方にアドバイスをいただきながら、初めてlaravelで自分のアプリケーションを作りました。laravelの便利だけど複雑な仕組みやファイル構成に悪戦苦闘しながら制作しました。稚拙な出来ですが、これを機にlaravelでもっと高度なアプリケーションを作れるように学習に励んでいきたいです。
# 開発環境
* Laravel 5.5  
* MySQL 5.7  
* phpmyadmin
* Docker Desktop for Windows
# 主な機能
## ユーザー向け
* 商品をカートに入れて、購入  
欲しい商品をカートに入れたのち、カートの中身を確認してから購入する。カート内の商品は個数変更したり削除したりできる。
* 購入履歴  
購入した商品の日時、値段、個数などの履歴を閲覧できる。
## 管理者向け
* 商品の新規登録  
商品の名前、値段、在庫数、画像、公開ステータスを登録する。
* 商品の情報更新  
商品の在庫数、公開ステータスを変更できる。商品を削除できる。
## 共通
* ログイン、ログアウト  
ログインすることで商品の購入や履歴の閲覧ができる。管理者は商品の管理ができる。
* 新規会員登録  
