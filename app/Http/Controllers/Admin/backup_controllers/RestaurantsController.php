<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Review;
use App\Dish;
use Illuminate\Support\Facades\Route;
use Storage;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

/* Admin restaurants controller */
class RestaurantsController extends Controller
{
    public function index()
	{
		$restaurants = Restaurant::all()->sortBy('name');
		
		return view("admin/restaurants/list", [
			'restaurants' => $restaurants
		]);
	}
	
	public function create(Restaurant $restaurant)
	{
		return view("admin/restaurants/create", [
			'restaurant' => $restaurant
		]);
	}
	
	public function store(Request $request)
	{
		//dd($request);
		
		request()->validate([
			'title' => 'required',
			'description' => 'required',
			'slug' => 'required',
			'streetaddress' => 'required',
			'streetaddresstwo' => 'sometimes',
			'city' => 'required',
			'stateprovince' => 'required',
			'country' => 'required',
			'cuisine' => 'required',
			'image' => 'sometimes|file|image|max:5000',
		]);
		
		$restaurant = new Restaurant;
		/*
		if($request->has('image')) {
            // resize and upload image
            $path = 'storage/images/' . $request->image->getClientOriginalName();
            $public_path = 'images/' . $request->image->getClientOriginalName();
            $resizedimage = Image::make( $request->image )
                ->resize(300, 200)
                ->save( $path );
            
            $restaurant->image = $public_path;
		}
		*/
		
		$restaurant->address = array(
			"streetaddress" => $request->streetaddress,
			"city"           => $request->city,
			"stateprovince"  => $request->stateprovince,
			"country"        => $request->country,
		);
		
		if( $request->filled('streetaddresstwo') ) {
			$restaurant->address = Arr::add( $restaurant->address, "streetaddresstwo", $request->streetaddresstwo );
		}
		
		$restaurant->name = request('title');
		$restaurant->description = request('description');
		$restaurant->slug = request('slug');
		$restaurant->cuisine = request('cuisine');
		
		$restaurant->save();
		
		return redirect("/admin/restaurants");
	}
	
	public function show(Restaurant $restaurant)
	{
		$dishes = Dish::where('menu_id', $restaurant->id)->get();
		
		return view("admin/restaurants/show", [
			"restaurant" => $restaurant,
			"dishes" => $dishes,
		]);
	}
	
	public function edit(Restaurant $restaurant)
	{
		return view("admin/restaurants/edit", [
			"restaurant" => $restaurant,
		]);
	}
	
	public function update(Request $request,  Restaurant $restaurant)
	{
		//dd($request);
		
		request()->validate([
			'title' => 'required',
			'description' => 'required',
			'slug' => 'required',
			'streetaddress' => 'required',
			'streetaddresstwo' => 'sometimes',
			'city' => 'required',
			'stateprovince' => 'required',
			'country' => 'required',
			'cuisine' => 'required',
			'image' => 'sometimes|file|image|max:5000',
		]);
		/*
		if($request->has('image')) {
            // resize and upload image
            $path = 'storage/images/' . $request->image->getClientOriginalName();
            $public_path = 'images/' . $request->image->getClientOriginalName();
            $resizedimage = Image::make( $request->image )
                ->resize(300, 200)
                ->save( $path );
            
            $restaurant->image = $public_path;
		}
		*/
		$restaurant->address = array(
			"streetaddress" => $request->streetaddress,
			"city"           => $request->city,
			"stateprovince"  => $request->stateprovince,
			"country"        => $request->country,
		);
		
		$restaurant->cuisine = array(
			$request->cuisineone,
			$request->cuisinetwo,
			$request->cuisinethree
		);
		
		if( $request->filled('streetaddresstwo') ) {
			//dd("Request has streetaddresstwo");
			$restaurant->address = Arr::add( $restaurant->address, "streetaddresstwo", $request->streetaddresstwo );
		}
		
		$restaurant->name = request('title');
		$restaurant->description = request('description');
		$restaurant->slug = request('slug');
		$restaurant->cuisine = request('cuisine');
		$restaurant->save();
		
		return redirect("admin/restaurants/");
	}
	
	public function createdish(Restaurant $restaurant)
	{
		return view('admin/restaurants/createdish', [
			'restaurant' => $restaurant
		]);
	}
	
	public function destroy(Restaurant $restaurant)
	{
		$restaurant->delete();
		
		return redirect("/admin/restaurants");
	}
	
	public function listdishes(Restaurant $restaurant)
	{
		$dishes = Dish::where("menu_id", $restaurant->id)->get();
		//public.restaurants.dishes.list
		if( Route::currentRouteName() == 'public.restaurants.dishes.list' ) {
			
			return view('restaurants/listdishes', [
				"restaurant" => $restaurant,
				"dishes" => $dishes
			]);
		}
		
		//admin.restaurants.dishes.list
		if( Route::currentRouteName() == 'admin.restaurants.dishes.list' ) {
			
			return view("admin/restaurants/listdishes", [
				"restaurant" => $restaurant,
				"dishes" => $dishes
			]);
		}
	}
	
	public function listreviews(Restaurant $restaurant)
	{
		$reviews = Review::where("restaurant_id", $restaurant->id)->get();
		
		return view("admin/restaurants/listreviews", [
			"reviews" => $reviews
		]);
	}
}









