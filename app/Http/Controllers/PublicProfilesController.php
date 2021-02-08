<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PublicProfilesController extends Controller
{
    public function show(User $user)
    {
    	return view("publicprofile", [
    		"user" => $user
    	]);
    }

    public function follow(User $user)
    {
    	$following = Auth()->user();
		$followed = $user;

    	$following->followings()->attach($followed);

    	return redirect()->back()->with('success_message', ('Successfully followed'.$user->name));
    }

    public function unfollow(User $user)
    {
        $following = Auth()->user();

        $following->followings()->detach($user);

        return redirect()->back()->with('success_message', ('Successfully unfollowed'.$user->name));
    }
}
