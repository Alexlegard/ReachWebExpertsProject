<?php

namespace App\Http\Controllers\Superadmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
	
	// Where to redirect users after resetting their password.
	protected $redirectTo = '/admin/dashboard';
	
	// Only super admin is allowed except for logout.
	public function __construct()
	{
		$this->middleware('guest:superadmin');
	}
	
	// Show the reset password form
	public function showResetForm(Request $request, $token = null) {
		
		return view('superadmin.auth.passwords.reset', [
			'title' => 'Reset Super Admin Password',
			'passwordUpdateRoute' => 'superadmin.password.update',
			'token' => $token,
		]);
	}
	
	// Get the broker to be used during password reset.
	protected function broker() {
		
		return Password::broker('superadmins');
	}
	
	// Get the guard to be used during password reset.
	protected function guard() {
		return Auth::guard('superadmin');
	}
}
