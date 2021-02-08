<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
	
	/**
	 * Show the reset email form.
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function showLinkRequestForm(){
		//dd("Hello.");
	   return view('auth.passwords.email',[
		  'title' => 'Password Reset',
		  'passwordEmailRoute' => 'password.email'
	   ]);
	}
}
