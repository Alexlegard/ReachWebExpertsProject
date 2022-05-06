<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Dish;
use Illuminate\Support\Facades\Route;
use Storage;
use Intervention\Image\Facades\Image as Image;

/* Public dishes controller */
class DishesController extends Controller
{	
	public function index_public($id)
	{
		$dishes = Dish::where('menu_id', $id)->get();
		
		return view('dishes.list', [
			'dishes' => $dishes
		]);
	}
	
	public function show(Dish $dish)
	{
		$restaurant = $dish->menu->restaurant;
		
		if( Route::currentRouteName() == 'admin.dishes.show' ) {
			
			return view("admin/dishes/show", [
				"dish" => $dish,
				"restaurant" => $restaurant
			]);
		}
		if( Route::currentRouteName() == 'public.dishes.show' ) {
			
			return view("dishes/show", [
				"dish" => $dish,
				"restaurant" => $restaurant
			]);
		}
	}
}









