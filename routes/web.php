<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here I have routes listed that don't fall under my other route files:
| adminlteRoutes.php, authRoutes.php, and profileRoutes.php.
|
*/

/* Public guest routes */
/* Welcome */
Route::get('/', 'WelcomeController@index')->name('welcome');
Auth::routes(['verify' => true]);
/* Home */
Route::get('/home', 'HomeController@index')->name('home');
/* About */
Route::get('/about', 'AboutController@index')->name('about');
/* Public restaurants page */
Route::get('/restaurants/{restaurant:slug}', 'RestaurantsController@show')
	->middleware('throttle')
	->name('public.restaurants.show');
/* Store new review */
Route::post('/restaurants/{restaurant}/review', 'ReviewsController@store')
	->middleware(['auth', 'verified'])
	->middleware('throttle')
	->name('reviews.store');
/* Delete review */
Route::delete('/reviews/{review}/delete', 'ReviewsController@delete')
	->name('reviews.delete');
	
/* Favorites */
Route::post('favorite', 'FavoritesController@favorite')
	->name('favorite');
Route::post('unfavorite/{restaurant}', 'FavoritesController@unfavorite')
	->name('unfavorite');
/* Search */
Route::get('/search', 'SearchController@search')
	->name('search');
/* Public user page */
Route::get('/user/{user}', 'PublicProfilesController@show')
	->name('user.public-profile');
/* Follow user */
Route::post('/user/{user}/follow', 'PublicProfilesController@follow')
	->name('user.follow');
/* Unfollow user */
Route::post('user/{user}/unfollow', 'PublicProfilesController@unfollow')
	->name('user.unfollow');

/************************************************** Ecommerce related routes */
/* Show all dishes from a restaurant */
Route::get('/restaurants/{restaurant:slug}/dishes', 'RestaurantsController@listdishes')
	->name('public.restaurants.dishes.list');
/* Show a dish */
Route::get('/dishes/{dish}', 'DishesController@show')
	->name('public.dishes.show');
/* Add a dish to the cart */
Route::post('/cart', 'CartsController@store')
	->name('cart.store');
/* Update the cart quantity */
Route::patch('cart/updatequantity', 'CartsController@updatequantity')
	->name('cart.updatequantity');
/* Delete a dish from the cart */
Route::delete('/profile/cart/{dish}', 'CartsController@destroy')
	->name('cart.destroy');
/* Show the cart page */
Route::get('/cart', 'CartsController@show')
	->name('cart.show');
/* Show the checkout page */
Route::get('checkout', 'CheckoutController@index')
	->middleware(['auth', 'verified'])
	->middleware('password.confirm')
	->name('checkout.index');
/* Make the order */
Route::post('/checkout/store', 'CheckoutController@store')
	->middleware(['auth', 'verified'])
	->name('checkout.store');
/* Show thank you message */
Route::get('thankyou', 'ThankyouController@index')
	->middleware(['auth', 'verified'])
	->name('thankyou');
/* Empty cart */
Route::get('empty', function() {
	Cart::destroy();
});

/* Store coupon */
Route::post('coupon', 'CouponsController@store')
	->name('coupon.store');
/* Delete coupon */
Route::delete('coupon', 'CouponsController@destroy')
	->name('coupon.destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');













