<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as User;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// must implement interface Illuminate\Contracts\Auth\Authenticatable
class Admin extends User implements Authenticatable
{
	use Notifiable;
	use AuthenticableTrait;
	use HasFactory;

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
		
		static::created(function($admin) {
			$admin->profile()->create([
				'description' => 'Welcome to my restaurant owner profile.'
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
		$this->notify(new AdminResetPasswordNotification($token));
	}
	
	public function restaurants()
	{
		return $this->belongsToMany(Restaurant::class);
	}
	
	public function restaurant_applications()
	{
		return $this->hasMany(RestaurantApplication::class);
	}
	
	public function AdminRestaurant()
	{
		return $this->belongsTo(AdminRestaurant::class);
	}
	
	public function profile()
	{
		return $this->hasOne(AdminProfile::class);
	}

	public function invoices()
	{
		return $this->hasMany(Invoice::class);
	}
}
