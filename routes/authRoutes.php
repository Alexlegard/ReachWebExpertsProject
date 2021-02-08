<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;

/***************************************Admin authentication related routes */
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
	
	Route::namespace('Auth')->group(function(){
		// Login/Logout Routes
		Route::get('/login', 'LoginController@showLoginForm')
			->name('admin.login');
		Route::get('/', function() {
			return redirect()->route('admin.admin.login');
		});
		Route::post('/login', 'LoginController@login');
		Route::post('/logout', 'LoginController@logout')
			->name('admin.logout');

		// Register route
		Route::get('/register/{token}', 'RegisterController@showRegistrationForm')
			->name('admin.showregister');
		Route::post('/register', 'RegisterController@register')
			->name('admin.register');

		// Forgot Password Routes
		Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')
			->name('password.request');
		Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')
			->name('password.email');

		// Reset Password Routes
		Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')
			->name('password.reset');
		Route::post('/password/reset','ResetPasswordController@reset')
			->name('password.update');
	});
});

/**************************************** Superadmin authentication related routes */
Route::prefix('/superadmin')->name('superadmin.')->namespace('Superadmin')->group(function(){

	Route::namespace('Auth')->group(function(){
		// Login/Logout routes
		Route::get('/login', 'LoginController@showLoginForm')
			->name('superadmin.login');
		Route::get('/', function() {
			return redirect()->route('superadmin.superadmin.login');
		});
		Route::post('/login', 'LoginController@login');
		Route::post('/logout', 'LoginController@logout')
			->name('superadmin.logout');
			
		// Forgot password routes
		Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')
			->name('password.request');
		Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')
			->name('password.email');
			
		// Reset Password Routes
		Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')
			->name('password.reset');
		Route::post('/password/reset','ResetPasswordController@reset')
			->name('password.update');
	});
});	