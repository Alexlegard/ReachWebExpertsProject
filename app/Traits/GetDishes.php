<?php

namespace App\Traits;

use Auth;
use App\Admin;
use App\Order;

trait GetDishes {
	
	public function getDishesFromAdmin(Admin $admin) {
		
		$dishes_array = array();
		
		foreach($admin->restaurants as $restaurant) {
			foreach($restaurant->menu->dish as $dish) {
				array_push($dishes_array, $dish);
			}
		}
		$dishes = collect($dishes_array);
		return $dishes;
	}
	
	public function getDishesFromOrder(Order $order) {
		
		$dishes_array = array();
		
		foreach($order->dishes as $dish) {
			array_push($dishes_array, $dish);
		}
		$dishes = collect($dishes_array);
		return $dishes;
	}
}