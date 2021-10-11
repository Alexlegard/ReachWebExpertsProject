<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Auth;
use App\Traits\GetAddressStrings;
use App\Traits\GetCuisinesStrings;
use App\Traits\GetOrders;

class RestaurantsController extends Controller
{
	use GetAddressStrings;
	use GetCuisinesStrings;
	use GetOrders;
	
    /**
     * Display a listing of the restaurant.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::paginate(20);
		
		return view("superadmin/restaurants/index", [
			'restaurants' => $restaurants
		]);
    }

    /**
     * Display the specified restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
		$superadmin = Auth::guard('superadmin')->user();
		$address = $this->getRestaurantAddressString($restaurant);
		$cuisines = $this->getRestaurantCuisinesString($restaurant);
		$orders = $this->getOrdersFromRestaurant($restaurant);
		
        return view("superadmin/restaurants/show", [
			'restaurant' => $restaurant,
			'address' => $address,
			'cuisines' => $cuisines,
			'orders' => $orders
		]);
    }

    /**
     * Remove the specified restaurant from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
		return redirect('admin/restaurants');
    }
}
