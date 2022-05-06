<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
	
//$this->middleware(['auth','verified']);

Route::prefix('profile')->group(function() {
	Route::group(['middleware' => ['is_user']], function() {

		/***************************************** Show profile ******************/
		Route::get('/', 'ProfilesController@profile')
			->middleware(['auth', 'verified'])
			->name('profile.show');

		/***************************************** Orders ************************/
		/* Show user's previous orders */
		Route::get('orders', 'OrdersController@list')
			->middleware(['auth', 'verified'])
			->name('orders.list');
		/* Show a user's order */
		Route::get('orders/{order}', 'OrdersController@show')
			->middleware(['auth', 'verified'])
			->name('orders.show');

		/***************************************** Reviews ***********************/
		/* Show user's reviews */
		Route::get('reviews', 'ReviewsController@listUserReviews')
			->middleware(['auth', 'verified'])
			->name('public.reviews.list');
		
		/***************************************** Change password ***************/
		/* Change password form */
		Route::get('changepassword', 'ProfilesController@changepassword')
			->middleware(['auth', 'verified'])
			->name('profile.changepassword');

		/********************** Settings (name, email, description) **************/
		/* Edit settings */
		Route::get('edit/settings', 'ProfilesController@editsettings')
			->middleware(['auth', 'verified'])
			->name('profile.edit.settings');
		/* Update settings */
		Route::patch('{profile}/editsettings', 'ProfilesController@updatesettings')
			->middleware(['auth', 'verified'])
			->name('profile.update.settings');

		/************************************* Favorites and feed **************/
			
		/* Show favorites */
		Route::get('favorites', 'FavoritesController@index')
			->middleware(['auth', 'verified'])
			->name('profile.favorites');

		/* Show feed */
		Route::get('feed', 'FeedController@index')
			->middleware(['auth', 'verified'])
			->name('profile.feed');

		/************************************* Address *************************/
		/* Edit address */
		Route::get('edit/address', 'ProfilesController@editaddress')
			->middleware(['auth', 'verified'])
			->name('profile.edit.address');
		/* Update address */
		Route::patch('{profile}/editaddress', 'ProfilesController@updateaddress')
			->middleware(['auth', 'verified'])
			->name('profile.update');
		
		/* Update shipping address */
		Route::patch('{profile}/editshippingaddress', 'ProfilesController@updateshippingaddress')
			->middleware(['auth', 'verified'])
			->name('profile.updateshippingaddress');
		
		/* Update billing address */
		Route::patch('{profile}/editbillingaddress', 'ProfilesController@updatebillingaddress')
			->middleware(['auth', 'verified'])
			->name('profile.updatebillingaddress');

		/************************************** Avatar *************************/

		Route::get('edit/avatar', 'ProfilesController@editavatar')
			->middleware(['auth', 'verified'])
			->name('profile.edit.avatar');

		Route::patch('{profile}/editavatar', 'ProfilesController@updateavatar')
			->middleware(['auth', 'verified'])
			->name('profile.updateavatar');
	});
});