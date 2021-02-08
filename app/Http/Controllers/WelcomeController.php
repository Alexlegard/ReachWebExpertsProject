<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Auth;
use App\Favorite;

class WelcomeController extends Controller
{
    public function index() {
		
		$restaurants = Restaurant::paginate(10);
		
		if( Auth::check() ) {
			$favorites = Favorite::where('user_id', Auth::user()->id)->pluck('restaurant_id');
		} else {
			$favorites = null;
		}
		
		return view("welcome", [
			'restaurants' => $restaurants,
			'favorites' => $favorites
		]);
	}


}