<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $guarded = [];
	
    public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function dishes()
	{
		return $this->belongsToMany(Dish::class, 'carts_dishes');
	}
}
