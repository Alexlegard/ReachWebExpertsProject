<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];
	
	public function restaurant()
	{
		return $this->belongsTo(Restaurant::class);
	}
	
	public function dish()
	{
		return $this->hasMany(Dish::class);
	}
}
