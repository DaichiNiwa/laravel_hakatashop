<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
\Route::get('/', 'ItemsController@index');

Auth::routes();

// リソースルーティングを使用
\Route::resource('admin', 'AdminController');
\Route::resource('items', 'ItemsController');
\Route::resource('carts', 'CartsController')->except(['store']);
\Route::resource('histories', 'HistoriesController');
// storeメソッドはitemをinplicit Bindingで
// 渡したいので、別にルーティングを設定
\Route::post('carts/{item}', 'CartsController@store');
// 購入完了処理の後、url(finish)へ
\Route::get('finish', 'ProcessController@finish');

