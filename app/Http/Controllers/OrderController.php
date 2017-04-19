<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Order;
use App\OrderMenu;
use Log;

class OrderController extends Controller
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
     * Show the order index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('customer')->get();
        $orders_ongoing = Order::with('customer')->where('status', 0)->get();
        $orders_completed = Order::with('customer')->where('status', 1)->get();
        $orders_menu = OrderMenu::with('order')->where('status', 0)->get();
        $data = array(
            'orders'  => $orders,
            'orders_menu'   => $orders_menu,
            'orders_ongoing'   => $orders_ongoing,
            'orders_completed'   => $orders_completed
        );
        return view('order.index')->with($data);
    }

    public function FinishedChecklist(Request $req){
        $id = $req->input('id');
        $order_menu = OrderMenu::find($id);
        $order_menu->status = 1;
        $order_menu->save();
        $response = [
                'status' => 'success',
                'msg' => 'You have liked this status',
            ];

        return \Response::json($response);
    }

     public function CheckOut(Request $req){
        $id = $req->input('id');
        $orders_menu = OrderMenu::all()->where('order_id',$id)->where('status', 0);
        if(count($orders_menu)==0){
            $order = Order::find($id);
            $order->status = 1;
            $order->save();
            $response = [
                    'status' => 'success',
                    'msg' => 'You have liked this status',
                ];
        } else {
             $response = [
                    'status' => 'no',
                    'msg' => 'Order is still ongoing!',
                ];
        }

        return \Response::json($response);
    }

    /**
     * Show the order detail
     *
     * @param $order_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($order_id)
    {
        return view('order.detail', ['order_id' => $order_id]);
    }
}
