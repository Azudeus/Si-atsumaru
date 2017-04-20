<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use Validator;


class PromotionController extends Controller
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
     * Show the promotion index
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $promotions = Promotion::all();
        return view('promotion.index')->with("promotions", $promotions);
    }

    public function addPromotion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'discount' => 'required|numeric|max:100',
            'valid_until' => 'required'
        ]);

       if ($validator->fails()) {
            return redirect('/promotion')
                ->withInput()
                ->withErrors($validator);
        }

        $promotion_data = collect($request->only([
            'name',
            'discount',
            'valid_until'
        ]))->all();

        $promo = Promotion::create($promotion_data);

        return redirect()->action("PromotionController@index");
    }

    public function editPromotion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:1000000',
            'name' => 'required|max:40',
            'discount' => 'required|max:100',
        ]);

        $promotion = Promotion::Find($request->id);

        $updates = [
        'name' => $request->name,
        'discount' => $request->discount,
        'valid_until' => $request->valid_until
        ];

        $promotion->update($updates);

        return redirect()->action("PromotionController@index");
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:1000000'
        ]);

        $promotion = Promotion::Find($request->id);

        $promotion->delete();
        
        return redirect()->action("PromotionController@index");   
    }

    /**
     * Show the promotion detail
     *
     * @param $promotion_id int
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($promotion_id)
    {
        return view('promotion.detail', ['promotion_id' => $promotion_id]);
    }
}
