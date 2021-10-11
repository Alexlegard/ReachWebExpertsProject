<?php

namespace App\Traits;

use Auth;
use App\Admin;
use App\Restaurant;
use App\Order;

trait GetRestaurants {
	
	public function getRestaurantsFromOrder(Order $order) {
		
		$restaurants_array = array();
		
		foreach($order->dishes as $dish) {
			array_push($restaurants_array, $dish->menu->restaurant);
		}

		$restaurants = collect($restaurants_array);
		return $restaurants;
	}

	public function getRestaurantsFromAdmin(Admin $admin) {

		$restaurants_array = array();

		foreach($admin->restaurants as $restaurant) {
			array_push($restaurants_array, $restaurant);
		}

		$restaurants = collect($restaurants_array);
		return $restaurants;
	}
}