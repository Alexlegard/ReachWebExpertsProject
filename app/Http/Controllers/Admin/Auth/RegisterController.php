<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
	use RegistersUsers;

    public function showRegistrationForm($token)
    {
    	return view("admin/auth/register", [
    		"token" => $token
    	]);
    }

    public function register(Request $request)
    {
    	request()->validate([
    		'name'             => 'required|string|max:255',
    		'email'            => 'required|string|email|max:255|unique:admins',
    		'password'         => 'required|string|min:6|confirmed',
    	]);

    	Admin::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect('/');
    }
}
