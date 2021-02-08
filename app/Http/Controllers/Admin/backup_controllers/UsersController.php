<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
	{
		$users = User::all()->sortBy('title');
		
		return view("admin/users/list", [
			'users' => $users
		]);
	}
	
	public function show(User $user)
	{
		return view("admin/users/show", [
			"user" => $user,
		]);
	}
	
	public function edit(User $user)
	{
		return view("admin/users/edit", [
			"user" => $user,
		]);
	}
	
	public function update(Request $request, User $user)
	{
		request()->validate([
			'name' => 'required',
		]);
		
		$user->name = $request->name;
		
		if($request->role != null) {
			$user->type = $request->role;
		}
		$user->save();
		
		return redirect("admin/users/");
	}
	
	public function destroy(User $user)
	{
		$user->delete();
		
		return redirect("admin/users");
	}
}
