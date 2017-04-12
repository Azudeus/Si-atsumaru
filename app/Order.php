<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    // public function menu(){
    //   return $this->hasMany('App\OrderMenu','id','id');
    // }

    public function customer(){
    	return $this->hasOne('App\Customer','id','customer_id');
    }
}
