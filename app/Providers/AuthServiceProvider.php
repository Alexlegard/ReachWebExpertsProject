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
        Order::class => OrderPolicy::class,
        Restaurant::class => RestaurantPolicy::class,
        Dish::class => DishPolicy::class,
        Review::class =>ReviewPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
	{
		$this->registerPolicies();
		
		
		
		/* Only regular admins can use this gate */
		Gate::define('add-restaurant', function ($user = null) {
			
			if( Auth::guard('admin')->check() ) {
				return true;
			}
			return false;
		});
		
		/* Only super admins can use this gate */
		Gate::define('view-users', function ($user = null) {
			
			if( Auth::guard('superadmin')->check() ) {
				return true;
			}
			return false;
		});
	}
}