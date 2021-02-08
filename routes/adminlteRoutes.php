<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;

Route::prefix('admin')->namespace('Admin')->group(function() {
	
	Route::group(['middleware' => ['is_admin_or_superadmin']], function() {
		/* Dashboard */
		Route::get('dashboard', 'AdminController@dashboard')
			->name('admin.dashboard');
		/* Logout page */
		Route::get('logout', 'AdminController@showLogoutPage')
			->name('admin.logout');
			
		
		/* admin/reviews */
		//List reviews
		Route::get('my-reviews', 'ReviewsController@index')
			->name('myreviews.index');
		//Show review
		Route::get('my-reviews/{review}', 'ReviewsController@show')
			->name('myreviews.show');
		//Edit review
		Route::get('my-reviews/{review}/edit', 'ReviewsController@edit')
			->name('myreviews.edit');
		//Update review
		Route::patch('my-reviews/{review}', 'ReviewsController@update')
			->name('myreviews.update');
		//Destroy review
		Route::delete('my-reviews/{review}', 'ReviewsController@destroy')
			->name('myreviews.destroy');
			
			
		/* admin/my-restaurants */
		Route::get('my-restaurants', 'MyRestaurantsController@index')
			->name('myrestaurants.index');
		//Create restaurant
		Route::get('my-restaurants/create', 'MyRestaurantsController@create')
			->name('restaurants.create');
		//Store restaurant application
		Route::post('restaurant-applications', 'RestaurantApplicationsController@store')
			->name('restaurantapplications.store');
		//Show restaurant
		Route::get('my-restaurants/{restaurant}', 'MyRestaurantsController@show')
			->name('myrestaurants.show');
		//Edit restaurant
		Route::get('my-restaurants/{restaurant}/edit', 'MyRestaurantsController@edit')
			->name('myrestaurants.edit');
		//Update restaurant
		Route::patch('my-restaurants/{restaurant}', 'MyRestaurantsController@update')
			->name('myrestaurants.update');
		//Edit social links
		Route::get('my-restaurants/{restaurant}/social-links/edit', 'SocialLinksController@edit')
			->name('myrestaurants.social-links.edit');
		//Update social links
		Route::patch('my-restaurants/{restaurant}/social-links', 'SocialLinksController@update')
			->name('myrestaurants.social-links.store');
		//Destroy restaurant
		Route::delete('my-restaurants/{restaurant}', 'MyRestaurantsController@destroy')
			->name('myrestaurants.destroy');
		//Create dish
		Route::get('my-restaurants/{restaurant}/create-dish', 'MyRestaurantsController@createdish')
			->name('my-restaurants/{restaurant}/create-dish');
		//Store dish
		Route::post('my-dishes/{id}', 'MyDishesController@store')
			->name('mydishes.store');
			
			
		/* admin/my-dishes */
		//List dishes
		Route::get('my-dishes', 'MyDishesController@index')
			->name('mydishes.index');
		//Show dish
		Route::get('my-dishes/{dish}', 'MyDishesController@show')
			->name('mydishes.show');
		//Edit dish
		Route::get('my-dishes/{dish}/edit', 'MyDishesController@edit')
			->name('mydishes.edit');
		//Update dish
		Route::patch('my-dishes/{dish}', 'MyDishesController@update')
			->name('mydishes.update');
		//Destroy dish
		Route::delete('my-dishes/{dish}', 'MyDishesController@destroy')
			->name('mydishes.destroy');
			
		
		//Show the form to put dish on sale
		Route::get('my-dishes/{dish}/sale', 'DiscountSalesController@create')
			->name('mydishes.saleform');
		//Put on sale
		Route::post('my-dishes/{dish}/sale', 'DiscountSalesController@store')
			->name('mydishes.sale');
		//Remove sale
		Route::delete('my-dishes/{dish}/unsale', 'DiscountSalesController@destroy')
			->name('mydishes.unsale');	
			
		/* admin/my-selections */
		//Add new dish selection
		Route::get('my-dishes/{dish}/selections/add', 'DishSelectionsController@create')
			->name('mydishes.selections.create');
		//Store new dish selection
		Route::post('my-dishes/selections/{id}', 'DishSelectionsController@store')
			->name('mydishes.selections.store');
		//Show dish selection
		Route::get('my-selections/{dishselection}', 'DishSelectionsController@show')
			->name('mydishselections.show');
		//Edit dish selection
		Route::get('my-selections/{dishselection}/edit', 'DishSelectionsController@edit')
			->name('mydishselections.edit');
		//Update dish selection
		Route::patch('my-selections/{dishselection}', 'DishSelectionsController@update')
			->name('mydishselections.update');
		//Delete dish selection
		Route::delete('my-selections/{dishselection}', 'DishSelectionsController@destroy')
			->name('mydishselections.destroy');
		
		
		/* admin/orders */
		// Show orders table
		Route::get('my-orders', 'OrdersController@index')
			->name('myorders.index');
		// Show order
		Route::get('my-orders/{order}', 'OrdersController@show')
			->name('myorders.show');
			
		/* admin/my-sales */
		// Show sales table
		Route::get('my-sales', 'SalesController@index')
			->name('mysales.index');
			
		/* admin/my-profile */
		// Show profile
		Route::get('my-profile', 'ProfileController@show')
			->name('myprofile.show');
		// Edit profile
		Route::get('my-profile/edit', 'ProfileController@edit')
			->name('myprofile.edit');
		// Update profile
		Route::patch('my-profile/{adminProfile}', 'ProfileController@update')
			->name('myprofile.update');
	});
});


Route::prefix('admin')->namespace('Superadmin')->group(function() {

	Route::group(['middleware' => ['is_superadmin']], function() {
		
		/* admin/restaurants */
		//List restaurants
		Route::get('restaurants', 'RestaurantsController@index')
			->name('restaurants.index');
		//Show restaurant
		Route::get('restaurants/{restaurant}', 'RestaurantsController@show')
			->name('restaurants.show');
		//Delete restaurant
		Route::delete('restaurants/{restaurant}', 'RestaurantsController@destroy')
			->name('restaurants.destroy');
		
		/* admin/restaurant-applications */
		//List restaurant applications
		Route::get('restaurant-applications', 'RestaurantApplicationsController@index')
			->name('restaurant-applications.index');
		//Show restaurant application
		Route::get('restaurant-applications/{restaurantApplication}', 'RestaurantApplicationsController@show')
			->name('restaurant-applications.show');
		//Approve restaurant application
		Route::post('restaurant-applications/{restaurantApplication}/approve', 'RestaurantApplicationsController@approve')
			->name('restaurant-applications.approve');
		//Deny restaurant application
		Route::delete('restaurant-applications/{restaurantApplication}/deny', 'RestaurantApplicationsController@deny')
			->name('restaurant-applications.deny');
		
		/* admin/dishes */
		//List dishes
		Route::get('dishes', 'DishesController@index')
			->name('dishes.index');
		//Show dish
		Route::get('dishes/{dish}', 'DishesController@show')
			->name('dishes.show');
		
		
		
		/* admin/orders */
		//List orders
		Route::get('orders', 'OrdersController@index')
			->name('orders.index');
		//Show order
		Route::get('orders/{order}', 'OrdersController@show')
			->name('orders.show');
			
			
		/* admin/sales */
		// Show sales table
		Route::get('sales', 'SalesController@index')
			->name('sales.index');
		
		
		
		/* admin/reviews */
		//List reviews
		Route::get('reviews', 'ReviewsController@index')
			->name('orders.index');
		//Show review
		Route::get('reviews/{review}', 'ReviewsController@show')
			->name('orders.show');
		//Delete review
		Route::delete('reviews/{review}', 'ReviewsController@destroy')
			->name('orders.delete');
		
		
		
		/* admin/users */
		//List users
		Route::get('users', 'UsersController@index')
			->name('users.index');
		//Show user
		Route::get('users/{user}', 'UsersController@show')
			->name('users.show');
		//Ban user
		Route::patch('users/{user}/ban', 'UsersController@ban')
			->name('users.ban');
		//Unban user
		Route::patch('users/{user}/unban', 'UsersController@unban')
			->name('users.unban');
		//Delete user
		Route::delete('users/{user}/delete', 'UsersController@destroy')
			->name('users.destroy');
		
		
		/* admin/admins */
		//Show registration email form
		Route::get('admins/send-registration-email', 'AdminsController@showRegistrationEmailForm')
			->name('admins.registration.show');
		//List admins
		Route::get('admins', 'AdminsController@index')
			->name('admins.list');
		//Show admin
		Route::get('admins/{admin}', 'AdminsController@show')
			->name('admins.show');
		//Send registration email
		Route::post('admins/sendRegistrationEmail', 'AdminsController@sendRegistrationEmail')
			->name('admins.registration.send');
		//Ban admin
		Route::patch('admins/{admin}/ban', 'AdminsController@ban')
			->name('admins.ban');
		//Unban admin
		Route::patch('admins/{admin}/unban', 'AdminsController@unban')
			->name('admins.unban');
		//Delete admin
		Route::delete('admins/{admin}/delete', 'AdminsController@destroy')
			->name('admins.destroy');
		
		
		
		/* admin/profile */
		//Show profile
		Route::get('profile', 'ProfileController@show')
			->name('profile.show');
		//Edit profile
		Route::get('profile/edit', 'ProfileController@edit')
			->name('profile.edit');
		//Update profile
		Route::patch('profile/{profile}/superadmin', 'ProfileController@update')
			->name('profile.update');
	});
});