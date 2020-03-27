<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Item;
use App\Services\PurchaseService;
use App\Services\AdminService;

class ItemsController extends Controller
{
    public function __construct(PurchaseService $purchase, AdminService $admin) {
        $this->purchase = $purchase;
        $this->admin = $admin;
        // authというミドルウェアを設定
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items_query = Item::where('status',1);
        // 検索キーワードがある場合
        if(isset($request->keyword)) {
            $items_query = $items_query->where('name', 'like', '%' . $request->keyword . '%');
        } 
        $items = $items_query->latest()->get();
        return view('items', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $user = \Auth::user();
        if($this->admin->is_admin($user) === false) {
            return redirect('items');
        }

        // 画像を保存し、ファイル名を取得
        $filename = $this->admin->save_image($request);

        $item = new Item([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $filename,
            'status' => $request->status,
            'stock' => $request->stock,
        ]);

        $item->save();
        session()->flash('modal_msg', '登録が完了しました。');
        return redirect('/admin');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Item $item)
    {
        $user = \Auth::user();
        if($this->admin->is_admin($user) === false) {
            return redirect('items');
        }
        // 在庫数の更新
        if(isset($request->stock)) {
            $item->stock = $request->stock;
        }
        // ステータスの更新
        if(isset($request->status)) {
            $item->status = $request->status;
        }

        $item->save();
        session()->flash('modal_msg', '更新が完了しました。');
        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $user = \Auth::user();
        if($this->admin->is_admin($user) === false) {
            return redirect('items');
        }
        // unlink('storage/photos/' . $item->image);
        \File::delete('storage/photos/' . $item->image);
        $item->delete();
        session()->flash('modal_msg', '削除が完了しました。');
        return redirect()->back();
    }
}
