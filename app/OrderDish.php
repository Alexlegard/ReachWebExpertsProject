<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDish extends Model
{
    protected $table = 'dish_order';
	
	protected $fillable  = ['order_id', 'dish_id', 'quantity'];
	
	public function order()
	{
		return $this->hasOne(Order::class);
	}
	
	public function dish()
	{
		return $this->hasOne(Dish::class);
	}
}
