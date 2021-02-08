<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\SuperAdminResetPasswordNotification;

class SuperAdmin extends Authenticatable
{
	 use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
	
	protected static function boot()
	{
		parent::boot();
		
		static::created(function($superadmin) {
			$superadmin->profile()->create([
				'description' => 'Welcome to my super admin profile.'
			]);
		});
	}

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new SuperAdminResetPasswordNotification($token));
	}
	
	public function profile()
	{
		return $this->hasOne(SuperAdminProfile::class);
	}
}
