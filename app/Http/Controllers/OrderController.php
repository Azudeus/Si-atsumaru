<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

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
        return view('order.index')->with("orders", $orders);
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
