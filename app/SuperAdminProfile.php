<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperAdminProfile extends Model
{
    protected $fillable = ['description'];
	
	public function superadmin()
	{
		return $this->belongsTo(SuperAdmin::class, 'super_admin_id');
	}
}
