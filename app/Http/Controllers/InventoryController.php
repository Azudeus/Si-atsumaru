<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use Validator;


class InventoryController extends Controller
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
     * Show the inventory index
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inventories = Inventory::all();
        return view('inventory.index')->with("inventories", $inventories);
    }

    public function addInventory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'stock' => 'required|max:1000000',
            'price' => 'required|max:1000000'
        ]);

       if ($validator->fails()) {
            return redirect('/inventory')
                ->withInput()
                ->withErrors($validator);
        }

        $inventory_data = collect($request->only([
            'name',
            'stock',
            'price'
        ]))->all();

        $inven = Inventory::create($inventory_data);

        return redirect()->action("InventoryController@index");
    }

    public function editInventory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:1000000',
            'name' => 'required|max:40',
            'stock' => 'required|max:1000000',
            'price' => 'required|max:1000000'
        ]);

        $inventory = Inventory::Find($request->id);

        $updates = [
        'name' => $request->name,
        'stock' => $request->stock,
        'price' => $request->price
        ];

        $inventory->update($updates);

        return redirect()->action("InventoryController@index");
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:1000000'
        ]);

        $inventory = Inventory::Find($request->id);

        $inventory->delete();
        
        return redirect()->action("InventoryController@index");   
    }

    /**
     * Show the inventory detail
     *
     * @param $inventory_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($inventory_id)
    {
        return view('inventory.detail', ['inventory_id' => $inventory_id]);
    }
}
