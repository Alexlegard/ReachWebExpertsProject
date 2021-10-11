<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

/* Admin login controller */
class LoginController extends Controller
{
	
    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
		return view('admin/auth/login');
		/*
        return view('auth.login',[
            'title' => 'Admin Login',
            'loginRoute' => 'admin.login',
            'forgotPasswordRoute' => 'admin.password.request',
        ]);*/
    }

    /**
     * Login the admin.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
		
        //Validation...
		$this->validator($request);
        
		$credentials = $request->only('email', 'password');
		
		if(Auth::guard('admin')->attempt($credentials))
		{
			//Authentication passed...
			Auth::guard('superadmin')->logout();
			Auth()->logout();
			
			$user = Admin::where('email', $request->email)->first();
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
			->route('admin.admin.login')
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
			'email'    => 'required|email|exists:admins|min:5|max:191',
			'password' => 'required|string|min:4|max:255',
		];

		//custom validation error messages.
		$messages = [
			'email.exists' => 'These credentials do not match our records.',
		];
		
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
