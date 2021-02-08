<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);
		
		return view("superadmin/users/index", [
			'users' => $users
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view("superadmin/users/show", [
			'user' => $user
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
		
		
        $user->delete();
		
		return redirect("admin/users");
    }
	
	public function ban(User $user)
	{
		$user->is_banned = true;
		
		$user->save();
		
		return redirect("admin/users/".$user->id);
	}
	
	public function unban(User $user)
	{
		$user->is_banned = false;
		
		$user->save();
		
		return redirect("admin/users/".$user->id);
	}
}
