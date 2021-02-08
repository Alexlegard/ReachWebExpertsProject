<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class SearchController extends Controller
{
    public function search(Request $request)
	{
		$request->validate([
			'query' => 'required|min:3'
		]);
		
		$query = $request->input('query');
		
		//$restaurants = Restaurant::where('name', 'like', "%{$query}%")
		//	->orWhere('description', 'like', "%{$query}%")
		//	->paginate(10);
		
		$restaurants = Restaurant::search($query)->paginate(10);
		
		return view('search-results', [
			"restaurants" => $restaurants
		]);
	}
}
