<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
	use SoftDeletes;

	protected $table = 'inventories';
    protected $primaryKey = 'id';
	protected $fillable = [
		'inventory_id',
		'name',
		'stock',
		'price'
	];
}
