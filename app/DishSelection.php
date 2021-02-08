<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishSelection extends Model
{
    protected $guarded = [];
	
	protected $casts = [
		'options' => 'array'
	];
	
	public function dish() {
		return $this->belongsTo(Dish::class);
	}
}
