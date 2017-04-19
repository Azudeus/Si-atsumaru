<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders_menus';

    public function order(){
    	return $this->hasOne('App\Order','id','order_id');
    }
}
