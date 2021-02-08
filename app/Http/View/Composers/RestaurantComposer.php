<?php

namespace Http\View\Composers;

use Auth;
use App\Favorite;

class RestaurantComposer {
	
	public function compose($view)
	{
		$favorites = Favorite::where('user_id', Auth::user()->id)->pluck('restaurant_id');
		
		$view->with('favorites', $favorites);
	}
}