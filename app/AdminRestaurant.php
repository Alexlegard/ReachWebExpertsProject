<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRestaurant extends Model
{
    protected $table = 'admin_restaurant';
	
	protected $fillable = ['admin_id', 'restaurant_id'];
	
	public function admin()
	{
		return $this->hasOne(Admin::class);
	}
	
	public function restaurant()
	{
		return $this->hasOne(Restaurant::class);
	}
}
