<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Auth;
use App\Dish;
use App\Traits\GetOrders;
use App\Traits\GetDishes;
use App\Traits\PaginateCollection;
use App\Http\Requests\MyDishRequest;

class MyDishesController extends Controller
{
	use GetOrders;
	use GetDishes;
	use PaginateCollection;
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$admin = Auth::guard('admin')->user();
		$dishes = $this->getDishesFromAdmin($admin);
		$restaurants = $this->getRestaurantsWithDishes();
		$restaurants = $this->paginate($restaurants, 10);
		
        return view("admin/myDishes/index", [
			'restaurants' => $restaurants,
			'dishes' => $dishes,
			'restaurants' => $restaurants
		]);
    }

    /**
     * Store a newly created resource in storage.
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
		
		$dish->save();
		
		return redirect("/admin/my-restaurants/" . $id);
		
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
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MyDishRequest $request, Dish $dish)
    {
        
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
		
		$dish->save();
		
		return redirect("/admin/my-dishes/" . $dish->id);
    }

    /**
     * Remove the specified resource from storage.
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
