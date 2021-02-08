<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    protected $fillable = ['description'];
	
	public function admin()
	{
		return $this->belongsTo(Admin::class);
	}
}
