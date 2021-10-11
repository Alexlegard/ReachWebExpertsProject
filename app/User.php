<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
	
	const ADMIN_TYPE = 'admin';
	const SUPER_TYPE = 'super';
	const DEFAULT_TYPE = 'user';
	
	protected static function boot()
	{
		parent::boot();
		
		static::created(function($user) {
			$user->profile()->create([
				'description' => 'Welcome to my Reach Web Experts profile.'
			]);
		});
	}
	
	public function isAdmin()
	{
		if($this->type == self::ADMIN_TYPE || $this->type == self::SUPER_TYPE){
			return true;
		}
		return false;
	}
	
	public function isSuperAdmin()
	{
		
		if($this->type == 'super'){
			return true;
		}
		return false;
	}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
		'billing_address' => 'array'
    ];
	
	public function profile()
	{
		return $this->hasOne(Profile::class);
	}
	
	public function review()
	{
		return $this->hasMany(Review::class);
	}
	
	public function orders()
	{
		return $this->hasMany(Order::class);
	}
	
	public function favorites()
	{
		return $this->belongsToMany(Restaurant::class, 'favorites');
	}

	public function followers()
	{
	    return $this->belongsToMany(User::class, 'followers', 'leader_id', 'follower_id')->withTimestamps();
	}

	public function followings()
	{
	    return $this->belongsToMany(User::class, 'followers', 'follower_id', 'leader_id')->withTimestamps();
	}
}





