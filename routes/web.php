<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Dashboard
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getChartData', 'HomeController@getChartData')->name('getChartData');

// Customers
Route::get('/customer', 'CustomerController@index')->name('customer');
Route::get('/customer/{id}', 'CustomerController@detail')->where('id', '[0-9]+');
Route::post('customer/add','CustomerController@addCustomer');
Route::post('customer/edit','CustomerController@editCustomer');
Route::post('customer/delete','CustomerController@delete')->name('delete_customer');

// Inventories
Route::get('/inventory', 'InventoryController@index')->name('inventory');
Route::get('/inventory/{id}', 'InventoryController@detail')->where('id', '[0-9]+');
Route::post('inventory/add','InventoryController@addInventory');
Route::post('inventory/edit','InventoryController@editInventory');
Route::post('inventory/delete','InventoryController@delete')->name('delete_inventory');

// Activities (Orders)
Route::get('/order', 'OrderController@index')->name('order');
Route::get('/order/{id}', 'OrderController@detail')->where('id', '[0-9]+');
Route::post('/order/finishedChecklist', 'OrderController@FinishedChecklist');
Route::post('/order/checkOut', 'OrderController@CheckOut');



// Menus
Route::get('/menu', 'MenuController@index')->name('menu');
Route::get('/menu/{id}', 'MenuController@detail')->where('id', '[0-9]+');
Route::post('menu/add','MenuController@addMenu');
Route::post('menu/edit','MenuController@editMenu');
// Route::post('menu/delete','MenuController@deleteMenu');
Route::post('menu/delete','MenuController@delete')->name('delete_menu');

// Promotions
Route::get('/promotion', 'PromotionController@index')->name('promotion');
Route::get('/promotion/{id}', 'PromotionController@detail')->where('id', '[0-9]+');
Route::post('promotion/add','PromotionController@addPromotion');
Route::post('promotion/edit','PromotionController@editPromotion');
Route::post('promotion/delete','PromotionController@delete')->name('delete_promotion');

// POS
Route::get('/pos', 'POSController@index')->name('pos');
Route::post('pos/add','POSController@addOrder')->name('addOrder');