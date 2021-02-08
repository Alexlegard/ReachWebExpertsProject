<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
	
	// Make the profile belong to a user
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	protected $casts = [
		'billing_address' => 'array',
        'shipping_address' => 'array'
    ];
}
