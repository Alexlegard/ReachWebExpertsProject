<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Restaurant;
use App\Favorite;

class FavoritesController extends Controller
{
	public function index()
	{
		$user = Auth::user();
		$restaurants = $user->favorites()->paginate(10);
		
		//$favorites = Favorite::where('user_id', Auth::user()->id)->pluck('restaurant_id');
		//$restaurants = Restaurant::with('favorited')
		//	->paginate(10);
		//$restaurants = $this->getFavorites(Auth::user());
		
		return view("profile/favorites", [
			'restaurants' => $restaurants
		]);
	}
	
    public function favorite(Request $request)
	{
		//dd("In favorite method.");
		
		Auth::user()->favorites()->attach($request->restaurantid);
		
		return back();
	}
	
	public function unfavorite(Request $request, Restaurant $restaurant)
	{
		//dd($restaurant);
		
		Auth::user()->favorites()->detach($restaurant->id);
		
		return back();
	}
	
	public function getFavorites($user)
	{
		
	}
}
