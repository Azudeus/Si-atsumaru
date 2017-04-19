<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models used
use App\Customer;
use App\Menu;
use App\Promotion;
use App\MenuPromotions;
use App\Order;
use App\OrderMenu;

class POSController extends Controller
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
     * Show the pos index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all customers
        $customers = Customer::all();
        // Get all menus
        $menus = Menu::all();
        // Get all promotions
        $promotions = Promotion::all();

        return view('pos.index', [
                'customers' => $customers,
                'menus' => $menus,
                'promotions' => $promotions
            ]);
    }

    public function addOrder(Request $request) {
        if ($request->has('customer_name')) {
            $customer_id = $request->input('customer_name');
            // HANDLE ORDER (only 1)
            $order = new Order;

            $order->total_discount = $request->input('total_price_in_form');
            $order->customer_id = $customer_id;
            $order->status = 0; // STATUS 0: new order

            $order->save();
            $order_id = $order->id;

            if ($request->has('count_menu')) {
                $count_menu = $request->input('count_menu');
                print($request->input('count_menu'));
                for($i=1; $i<$count_menu+1; $i++) {
                    if ($request->has('menu'.$i)) {
                        // HANDLE MENUS (can multiple)
                        $order_menu = new OrderMenu;
                        $order_menu->order_id = $order_id;
                        $data = explode(';', $request->input('menu'.$i));
                        print($request->input('menu'.$i));
                        $order_menu->menu_id = $data[0];
                        $order_menu->quantity = $data[1];
                        $order_menu->description = $data[3];
                        $order_menu->status = 0; //haven't been made

                        $data_promotion = explode(',', $data[2]);
                        print(count($data_promotion));
                        foreach ($data_promotion as $key => $value) {
                            // HANDLE PROMOTIONS (can multiple)
                            if($value != "") {
                                $menus_promotion = new MenuPromotions;
                                $menus_promotion->menu_id = $data[0];
                                $menus_promotion->promotion_id = $value;
                                $menus_promotion->order_id = $order_id;
                                $menus_promotion->save();
                            }
                        }

                        $order_menu->save();                    
                    }
                }
            }
        }

        return redirect()->action("OrderController@index");
    }
}
