<?php

namespace App\Http\Controllers;

use DateTime;

use Illuminate\Http\Request;
use App\Inventory;
use App\Constant;
use App\OrderMenu;
use App\Order;

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

    public function getChartData() {
        $data = [];
        $day = 6;
        while ($day >= 0) {
            $d = array();
            $date = new DateTime($day.' days ago');
            $d['date'] = $date->format("Y-m-d");
            $d['cash inflow'] = Order::whereDate('created_at', $date->format("Y-m-d"))->sum('total_discount');

            array_push($data, $d);

            $day--;
        }
        // echo $date->format('Y-m-d');

        return response()->json($data);
    }
}
