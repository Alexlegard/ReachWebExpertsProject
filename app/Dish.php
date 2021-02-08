<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
	protected $guarded = [];
	
	protected $casts = [
         'price' => 'array',
		 'special_price' => 'array',
    ];
	
	public function menu()
	{
		return $this->belongsTo(Menu::class);
	}
	
	
	
	public function orders()
	{
		return $this->belongsToMany(Order::class);
	}
	
	public function selections()
	{
		return $this->hasMany(DishSelection::class);
	}
}