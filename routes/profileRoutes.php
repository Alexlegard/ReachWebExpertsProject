<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
	
Route::prefix('profile')->group(function() {
	Route::group(['middleware' => ['is_user']], function() {

		/***************************************** Show profile ******************/
		Route::get('/', 'ProfilesController@profile')
			->middleware('auth')
			->name('profile.show');

		/***************************************** Orders ************************/
		/* Show user's previous orders */
		Route::get('orders', 'OrdersController@list')
			->middleware('auth')
			->name('orders.list');
		/* Show a user's order */
		Route::get('orders/{order}', 'OrdersController@show')
			->middleware('auth')
			->name('orders.show');

		/***************************************** Reviews ***********************/
		/* Show user's reviews */
		Route::get('reviews', 'ReviewsController@listUserReviews')
			->middleware('auth')
			->name('public.reviews.list');
		
		/***************************************** Change password ***************/
		/* Change password form */
		Route::get('changepassword', 'ProfilesController@changepassword')
			->middleware('auth')
			->name('profile.changepassword');

		/********************** Settings (name, email, description) **************/
		/* Edit settings */
		Route::get('edit/settings', 'ProfilesController@editsettings')
			->middleware('auth')
			->name('profile.edit.settings');
		/* Update settings */
		Route::patch('{profile}/editsettings', 'ProfilesController@updatesettings')
			->middleware('auth')
			->name('profile.update.settings');

		/************************************* Favorites and feed **************/
			
		/* Show favorites */
		Route::get('favorites', 'FavoritesController@index')
			->middleware('auth')
			->name('profile.favorites');

		/* Show feed */
		Route::get('feed', 'FeedController@index')
			->middleware('auth')
			->name('profile.feed');

		/************************************* Address *************************/
		/* Edit address */
		Route::get('edit/address', 'ProfilesController@editaddress')
			->middleware('auth')
			->name('profile.edit.address');
		/* Update address */
		Route::patch('{profile}/editaddress', 'ProfilesController@updateaddress')
			->middleware('auth')
			->name('profile.update');
		
		/* Update shipping address */
		Route::patch('{profile}/editshippingaddress', 'ProfilesController@updateshippingaddress')
			->middleware('auth')
			->name('profile.updateshippingaddress');
		
		/* Update billing address */
		Route::patch('{profile}/editbillingaddress', 'ProfilesController@updatebillingaddress')
			->middleware('auth')
			->name('profile.updatebillingaddress');

		/************************************** Avatar *************************/

		Route::get('edit/avatar', 'ProfilesController@editavatar')
			->middleware('auth')
			->name('profile.edit.avatar');

		Route::patch('{profile}/editavatar', 'ProfilesController@updateavatar')
			->middleware('auth')
			->name('profile.updateavatar');
	});
});