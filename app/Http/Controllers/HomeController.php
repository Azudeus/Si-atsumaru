<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Constant;
use App\OrderMenu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders_menu = OrderMenu::with('menu')->orderby('created_at','desc')->limit(5)->get();
        $inventories = Inventory::where('stock','<=', Constant::InventoryDanger)->get();
        $data = array(
            'inventories'  => $inventories,
            'orders_menu'   => $orders_menu
        );
        return view('home')->with($data);
    }
}
