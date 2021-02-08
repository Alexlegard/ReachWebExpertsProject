<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantApplication extends Model
{
	protected $table = "restaurant_applications";
	
    protected $fillable = [
		'admin_id', 'name', 'description', 'slug',
		'address', 'cuisine', 'image'
	];
	
	protected $casts = [
         'address' => 'array',
		 'cuisine' => 'array',
    ];
	
	public function admin()
	{
		return $this->belongsTo(Admin::class);
	}
}
