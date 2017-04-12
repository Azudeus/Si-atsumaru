<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';
    protected $fillable = ['name', 'email', 'address'];

    public function order(){
    	return $this->belongsTo('Order');
    }
}
