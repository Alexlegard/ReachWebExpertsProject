<?php

namespace App\Http\Controllers\Superadmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
	
	public function showLinkRequestForm() {
		
		return view('superadmin.auth.passwords.email', [
			'title' => 'Super Admin Password Reset',
			'passwordEmailRoute' => 'superadmin.password.email'
		]);
	}
	
	public function broker() {
		
		return Password::broker('superadmins');
	}
	
	public function guard() {
		
		return Auth::guard('superadmin');
	}
}
