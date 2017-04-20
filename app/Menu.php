<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus';
    protected $primaryKey = 'id';
	protected $fillable = [
		'inventory_id',
		'name',
		'price',
        'image'
	];
}
