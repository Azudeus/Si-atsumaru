<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Order;

class Customer extends Model
{
    use SoftDeletes;
    
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
