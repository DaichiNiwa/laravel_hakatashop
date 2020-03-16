<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Services\PurchaseService;
use App\Services\AdminService;

class AdminController extends Controller
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
    public function index()
    {
        $user = \Auth::user();
        if($this->admin->is_admin($user) === false) {
            return redirect('items');
        }
        
        // すべての商品を新着順に取得
        $items = Item::latest()->get();
        return view('admin', ['items' => $items]);
    }
}
