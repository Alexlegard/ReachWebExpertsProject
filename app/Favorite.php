<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
	
	protected $fillable = ['user_id', 'restaurant_id'];
	
	public function user() {
		return $this->hasOne(User::class);
	}
	
	public function restaurant() {
		return $this->hasOne(Restaurant::class);
	}
}
