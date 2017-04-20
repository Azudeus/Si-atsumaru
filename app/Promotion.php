<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promotions';
    protected $primaryKey = 'id';
	protected $fillable = [
		'promotion_id',
		'name',
		'discount',
		'valid_until'
	];    
}
