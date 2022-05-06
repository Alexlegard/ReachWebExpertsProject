<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Dish;
use Illuminate\Support\Facades\Route;
use Storage;
use Intervention\Image\Facades\Image as Image;
use App\Http\Controllers\Controller;

/* Admin dishes controller */
class DishesController extends Controller
{	
	public function index_public($id)
	{
		$dishes = Dish::where('menu_id', $id)->get();
		
		return view('dishes.list', [
			'dishes' => $dishes
		]);
	}
	
	public function store(Request $request, $id)
	{
		request()->validate([
			'name' => 'required',
			'description' => 'required',
			'slug' => 'required',
			'pricecurrency' => 'required',
			'priceamount' => 'required',
			'cuisine' => 'required',
			'calories' => 'sometimes|nullable',
			'peopleserved' => 'required',
			'isbeverage' => 'required',
			'isalcoholic' => 'required',
			'image' => 'sometimes|nullable|file|image|max:5000',
		]);
		
		$dish = new Dish;
		
		$dish->menu_id = $id;
		
		$dish->price = array(
			"currency" => $request->pricecurrency,
			"amount" => $request->priceamount,
		);
		
		if( request('calories') ) {
			$dish->calories = request('calories');
		}
		
		$dish->name = request('name');
		$dish->description = request('description');
		$dish->slug = request('slug');
		$dish->cuisine = request('cuisine');
		$dish->people_served = request('peopleserved');
		$dish->is_beverage = request('isbeverage');
		$dish->is_alcoholic = request('isalcoholic');
		
		$dish->save();
		
		return redirect("/admin/restaurants/" . $id);
	}
	
	public function show(Dish $dish)
	{
		$restaurant = $dish->menu->restaurant;
		
		return view("admin/dishes/show", [
			"dish" => $dish,
			"restaurant" => $restaurant
		]);
	}
	
	public function edit(Dish $dish)
	{
		return view("admin/dishes/edit", [
			"dish" => $dish,
		]);
	}
	
	public function update(Request $request, Dish $dish)
	{
		//dd($request->image);
		
		request()->validate([
			'name' => 'required',
			'description' => 'required',
			'slug' => 'required',
			'pricecurrency' => 'required',
			'priceamount' => 'required',
			'cuisine' => 'required',
			'peopleserved' => 'required',
			'isbeverage' => 'required',
			'image' => 'sometimes|nullable|file|image|max:5000',
		]);
		/* IMAGE CODE COPIED FROM RESTAURANTS CONTROLLER
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
		$dish->price = array(
			"currency" => $request->pricecurrency,
			"amount" => $request->priceamount,
		);
		$dish->name = request('name');
		$dish->description = request('description');
		$dish->slug = request('slug');
		$dish->cuisine = request('cuisine');
		$dish->people_served = request('peopleserved');
		$dish->is_beverage = request('isbeverage');
		
		$dish->save();
		
		return redirect("/admin/dishes/" . $dish->id);
	}
	
	public function destroy(Dish $dish)
	{
		$dish->delete();
		
		return redirect("/admin/dishes");
	}
}









