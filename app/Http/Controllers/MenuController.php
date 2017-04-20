<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Inventory;
use App\MenuInventories;
use Validator;
use Log;

class MenuController extends Controller
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
     * Show the menu index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        $inventories = Inventory::all();
        $data = array(
            'menus'  => $menus,
            'inventories'   => $inventories
        );
        return view('menu.index')->with($data);
    }

    public function addMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'price' => 'required|max:1000000',
            'madeof' => 'required'
        ]);

       if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        

        $tmpName  = $request->file('image')->getPathName();
        $fileData = file_get_contents($tmpName);
        $blob = base64_encode($fileData);

        $menu = Menu::create(['name' => $request->name, 'price' => $request->price, 'image' => $blob]);
        
        $menu_id = $menu->id;
        $madeof_menu =  $request->madeof;

        foreach ($madeof_menu as $inventory_id){
            $madeof_ = 'madeof_' . $inventory_id;
            $menu_inventory = MenuInventories::create(['menu_id' => $menu_id, 'inventory_id' => $inventory_id, 'inv_stock_needed' => $request->$madeof_]);
        }

        return redirect()->action("MenuController@index");
    }

    public function editMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'price' => 'required|max:1000000',
        ]);

        $menu = Menu::Find($request->id);

        $updates = [
        'name' => $request->name,
        'price' => $request->price,
        ];

        $menu->update($updates);

        return redirect()->action("MenuController@index");
    }

    // public function deleteMenu(Request $request){
    //     $menu_inventory = MenuInventories::all()->where('menu_id', $request->id);
    //     MenuInventories::destroy($menu_inventory->toArray());
    //     Menu::destroy($request->id);

    //     return redirect()->action("MenuController@index");
    // }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:1000000'
        ]);

        $menu = Menu::Find($request->id);

        $menu->delete();
        
        return redirect()->action("MenuController@index");   
    }

    /**
     * Show the menu detail
     *
     * @param $menu_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($menu_id)
    {
        return view('menu.detail', ['menu_id' => $menu_id]);
    }
}
