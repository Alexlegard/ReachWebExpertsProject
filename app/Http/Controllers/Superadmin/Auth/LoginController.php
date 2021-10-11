<?php

namespace App\Http\Controllers\Superadmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SuperAdmin;

/* Superadmin login controller */
class LoginController extends Controller
{
    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
		
        return view('superadmin/auth/login',[
            'title' => 'Super Admin Login',
            'loginRoute' => 'superadmin.login',
            'forgotPasswordRoute' => 'admin.password.request',
        ]);
    }
	
	/**
     * Login the superadmin.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
		//dd("Inside login method");
        //Validation...
		$this->validator($request);
        
		$credentials = $request->only('email', 'password');
		
		if(Auth::guard('superadmin')->attempt($credentials))
		{
			//Authentication passed...
			Auth::guard('admin')->logout();
			Auth()->logout();
			
			$user = SuperAdmin::where('email', $request->email)->first();
			//dd($user);
			
			return redirect("admin/dashboard");
		}
		//Login failed...
        return $this->loginFailed();
    }
	
	/**
     * Logout the admin.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
		//logout the admin...
		Auth::logout();
        Auth::guard('admin')->logout();
        Auth::guard('superadmin')->logout();
		
		return redirect()
			->route('superadmin.superadmin.login')
			->with('status','Admin has been logged out!');
    }
	
	/**
     * Validate the form data.
     * 
     * @param \Illuminate\Http\Request $request
     * @return 
     */
    private function validator(Request $request)
    {
		//validate the form...
		//validation rules.
		$rules = [
			'email'    => 'required|email|exists:super_admins|min:5|max:191',
			'password' => 'required|string|min:4|max:255',
		];
		
		//custom validation error messages.
		$messages = [
			'email.exists' => 'These credentials do not match our records.',
		];
		//dd("Inside validator method");
		//validate the request.
		$request->validate($rules,$messages);
	}
	
	/**
     * Redirect back after a failed login.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
		//Login failed...
		return redirect()
			->back()
			->withInput()
			->with('error','Login failed, please try again!');
    }
}








