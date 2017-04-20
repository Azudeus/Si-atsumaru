<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Validator;

class CustomerController extends Controller
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
     * Show the customer index
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the inventory index
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::all();
        return view('customer.index')->with("customers",$customers);
    }

    public function addCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'email' => 'email|max:1000000',
            'address' => 'max:1000000'
        ]);

       if ($validator->fails()) {
            return redirect('/customer')
                ->withInput()
                ->withErrors($validator);
        }

        $customer_data = collect($request->only([
            'name',
            'email',
            'address'
        ]))->all();

        $customer = Customer::create($customer_data);

        return redirect()->action("CustomerController@index");
    }

    public function editCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:1000000',
            'name' => 'required|max:40',
            'email' => 'email|max:1000000',
            'address' => 'max:1000000'
        ]);

        $customer = Customer::Find($request->id);

        $updates = [
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address
        ];

        $customer->update($updates);

        return redirect()->action("CustomerController@index");
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:1000000'
        ]);

        $customer = Customer::Find($request->id);

        $customer->delete();
        
        return redirect()->action("CustomerController@index");   
    }

    /**
     * Show the acustomer detail
     *
     * @param $customer_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($customer_id)
    {
        return view('customer.detail', ['customer_id' => $customer_id]);
    }
}
