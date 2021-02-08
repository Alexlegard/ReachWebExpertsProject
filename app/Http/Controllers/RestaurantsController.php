<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Review;
use App\Dish;
use Illuminate\Support\Facades\Route;
use Storage;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Arr;
use Carbon\Carbon;

/* Public restaurants controller */
class RestaurantsController extends Controller
{
    public function index()
	{
		
		$restaurants = Restaurant::all()->sortBy('name');
		
		return view("admin/restaurants/list", [
			'restaurants' => $restaurants
		]);
	}
	
	public function show(Restaurant $restaurant)
	{
		$dishes = Dish::where('menu_id', $restaurant->id)->get();
		$reviews = Review::where('restaurant_id', $restaurant->id)->get();
		
		return view("restaurants/show", [
			"restaurant" => $restaurant,
			"reviews" => $reviews,
			"dishes" => $dishes,
		]);
	}
	
	public function listdishes(Restaurant $restaurant)
	{
		$dishes = Dish::where("menu_id", $restaurant->id)
			->paginate(10);
		
		return view('restaurants/listdishes', [
			"restaurant" => $restaurant,
			"dishes" => $dishes
		]);
	}
	
	public function listreviews(Restaurant $restaurant)
	{
		$reviews = Review::where("restaurant_id", $restaurant->id)->get();
		
		return view("admin/restaurants/listreviews", [
			"reviews" => $reviews
		]);
	}
}









