<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Order::class      => OrderPolicy::class,
        Restaurant::class => RestaurantPolicy::class,
        Dish::class       => DishPolicy::class,
        Review::class     => ReviewsPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
	{
		$this->registerPolicies();
		
		
		
		/************* ADMIN GATES *************/
		//Restaurants
		Gate::define('owns-restaurant', function ($user = null, $restaurant) {

			if( Auth::guard('admin')->check() ) {
				
				$admin = Auth::guard('admin')->user();
				return $restaurant->admins->contains($admin->id);
			}
			return false;
		});

		Gate::define('owns-profile', function ($user = null, $adminProfile) {
			
			if( Auth::guard('admin')->check() ) {
				
				$admin = Auth::guard('admin')->user();
				return $admin->id == $adminProfile->admin->id;
			}
			return false;
		});

		Gate::define('add-restaurant', function ($user = null) {
			
			if( Auth::guard('admin')->check() ) {
				return true;
			}
			return false;
		});

		
		/************* SUPER ADMIN GATES *************/
		Gate::define('view-users', function ($user = null) {
			
			if( Auth::guard('superadmin')->check() ) {
				return true;
			}
			return false;
		});


	}
}