<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Http\Controllers\Controller;

class AdminsController extends Controller
{
    public function index()
	{
		$regularadmins = DB::table('users')->where('type', 'admin');
		
		$admins = DB::table('users')
			->where('type', 'super')
			->union($regularadmins)
			->get();
		
		return view("admin/admins/list", [
			'admins' => $admins,
		]);
	}
	
	public function show(User $user)
	{
		return view("admin/admins/show", [
			"admin" => $user,
		]);
	}
	
	public function edit(User $user)
	{
		return view("admin/admins/edit", [
			"admin" => $user,
		]);
	}
	
	public function update(Request $request, User $user)
	{
		request()->validate([
			'name' => 'required',
			'role' => 'required',
		]);
		
		$user->name = $request->name;
		$user->type = $request->role;
		
		$user->save();
		
		return redirect("admin/admins");
	}
	
	public function destroy(User $user)
	{
		$user->delete();
		
		return redirect("admin/admins");
	}
}
