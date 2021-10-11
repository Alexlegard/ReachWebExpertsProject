<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Auth;
use App\Dish;
use App\Traits\GetOrders;
use App\Traits\GetDishes;
use App\Traits\GetRestaurants;
use App\Traits\PaginateCollection;
use App\Http\Requests\MyDishRequest;
use Image;

class MyDishesController extends Controller
{
	use GetOrders;
	use GetDishes;
	use GetRestaurants;
	use PaginateCollection;
	
    /**
     * Display a listing of the dish.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$admin = Auth::guard('admin')->user();
		$dishes = $this->getDishesFromAdmin($admin);
		$restaurants = $this->getRestaurantsFromAdmin($admin);
		$restaurants = $this->paginate($restaurants, 10);
		
        return view("admin/myDishes/index", [
			'restaurants' => $restaurants,
			'dishes' => $dishes,
			'restaurants' => $restaurants
		]);
    }

    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MyDishRequest $request, $id)
    {
		$dish = new Dish;
		$dish->menu_id = $id;
		
		$dish->price = array(
			"currency" => $request->pricecurrency,
			"amount" => $request->priceamount,
		);
		
		$dish->special_price = array(
			"currency" => $request->pricecurrency,
			"amount" => $request->specialprice
		);
		
		if( request('calories') ) {
			$dish->calories = request('calories');
		}
		
		$dish->name = request('name');
		$dish->description = request('description');
		$dish->slug = request('slug');
		$dish->cuisine = request('cuisine');
		$dish->people_served = request('peopleserved');
		$dish->stock = request('stock');
		$dish->is_beverage = request('isbeverage');
		$dish->is_alcoholic = request('isalcoholic');
		
		if( request()->hasFile('image') )
		{
			$image = request()->file('image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			Image::make($image)->resize(300, 300)->save( public_path('storage/dishimages/'.$filename) );
			$dish->image = $filename;
		}

		$dish->save();
		
		return redirect("/admin/my-restaurants/" . $id);
    }

    /**
     * Display the specified dish.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
		$admin = Auth::guard('admin')->user();
		$orders = $this->getOrdersFromDish($dish);
		$restaurant = $dish->menu->restaurant;
		
        return view("admin/myDishes/show", [
			'dish' => $dish,
			'orders' => $orders,
			'restaurant' => $restaurant
		]);
    }

    /**
     * Show the form for editing the specified dish.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        return view("admin/myDishes/edit", [
			'dish' => $dish
		]);
    }

    /**
     * Update the specified dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MyDishRequest $request, Dish $dish)
    {
		$dish->price = array(
			"currency" => $request->pricecurrency,
			"amount" => $request->priceamount,
		);
		$dish->special_price = array(
			"currency" => $request->pricecurrency,
			"amount" => $request->specialprice
		);
		$dish->name = request('name');
		$dish->description = request('description');
		$dish->slug = request('slug');
		$dish->cuisine = request('cuisine');
		$dish->people_served = request('peopleserved');
		$dish->stock = request('stock');
		$dish->is_beverage = request('isbeverage');

		if( request()->hasFile('image') )
		{
			$image = request()->file('image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			Image::make($image)->resize(300, 300)->save( public_path('storage/dishimages/'.$filename) );
			$dish->image = $filename;
		}
		
		$dish->save();
		
		return redirect("/admin/my-dishes/" . $dish->id);
    }

    /**
     * Remove the specified dish from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
		$dishes_array = array();
		$restaurants = Auth::guard('admin')->user()->restaurants;
		
		foreach(Auth::guard('admin')->user()->restaurants as $restaurant) {
			foreach($restaurant->menu->dish as $dish) {
				array_push($dishes_array, $dish);
			}
		}
		$dishes = collect($dishes_array);
		
		return redirect('admin/my-dishes');
    }
	
	/*
	 * Returns all restaurants with at least one dish.
	 */
	public function getRestaurantsWithDishes() {
		
		$restaurants = collect();
		
		foreach(Restaurant::all() as $restaurant) {
			if($restaurant->menu->dish->count()) {
				$restaurants->push($restaurant);
			}
		}
		
		return $restaurants;
	}
}
