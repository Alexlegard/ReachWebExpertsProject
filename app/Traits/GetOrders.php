<?php

namespace App\Traits;

use Auth;
use App\Admin;
use App\Restaurant;
use App\Dish;
use Carbon\Carbon;
use App\Order;

trait GetOrders {
	
	
	public function getOrdersFromAdmin(Admin $admin){
		
		$orders = collect();
		$orders_query = Order::all();
		$admin_id = Auth::guard('admin')->user()->id;
		
		foreach( $orders_query as $order ) {
			$flag = false;
			foreach( $order->dishes as $dish ) {
				foreach( $dish->menu->restaurant->admins as $admin ) {
					if( $admin->id == $admin_id ) {
						$flag = true;
					}
				}
			}
			if( $flag ) {
				$orders->push($order);
			}
		}
		return $orders;
	}
	
	public function getOrdersFromRestaurant(Restaurant $restaurant) {
		
		$orders_array = array();
		
		foreach($restaurant->menu->dish as $dish) {
			foreach($dish->orders as $order) {
				array_push($orders_array, $order);
			}
		}
		$orders = collect($orders_array);
		return $orders;
	}
	
	public function getOrdersFromDish(Dish $dish) {
		
		$orders_array = array();
		return $dish->orders;
	}
	/* Today's orders ***********************************************************/
	
	// Return an admin's orders placed today
	public function getTodaysOrders(Admin $admin = null) {
		
		$orders_array = array();
		if( isset($admin) ) {
			$orders_query = $this->getOrdersFromAdmin($admin);
		} else {
			$orders_query = Order::all();
		}
		foreach( $orders_query as $order ) {
			if( Carbon::parse($order->time_placed)->isToday() ) {
				array_push( $orders_array, $order );
			}
		}
		$orders = collect($orders_array);
		return $orders;
	}
	
	/* Weekly orders ***********************************************************/
	
	// Returns an admin's orders placed this week
	public function getWeeklyOrders(Admin $admin = null) {
		
		$orders_array = array();
		if( isset($admin) ) {
			$orders_query = $this->getOrdersFromAdmin($admin);
		} else {
			$orders_query = Order::all();
		}
		foreach( $orders_query as $order ) {
			$parsed = Carbon::parse($order->time_placed);
			//dd($parsed->startOfWeek());
			if( $parsed->startOfWeek() == Carbon::now()->startOfWeek() ) {
				array_push( $orders_array, $order );
			}
		}
		$orders = collect($orders_array);
		return $orders;
	}
	
	// Returns an array containing count of an admin's orders each day of
	// this week to be used for a table.
	public function weeklyOrdersArray(Admin $admin = null) {
		
		$weekly_orders = [
			'monday' => 0,
			'tuesday' => 0,
			'wednesday' => 0,
			'thursday' => 0,
			'friday' => 0,
			'saturday' => 0,
			'sunday' => 0
		];
		if( isset($admin) ) {
			$orders = $this->getWeeklyOrders($admin);
		} else {
			$orders = $this->getWeeklyOrders();
		}
		//startOfWeek
		foreach( $orders as $order ) {
			
			$day_of_week = Carbon::parse($order->time_placed)->dayOfWeek;
			
			
			// Sunday
			if( $day_of_week==0 ) {
				$weekly_orders['sunday'] += 1;
			}
			// Monday
			else if( $day_of_week==1 ) {
				$weekly_orders['monday'] += 1;
			}
			// Tuesday
			else if( $day_of_week==2 ) {
				$weekly_orders['tuesday'] += 1;
			}
			// Wednesday
			else if( $day_of_week==3 ) {
				$weekly_orders['wednesday'] += 1;
			}
			// Thursday
			else if( $day_of_week==4 ) {
				$weekly_orders['thursday'] += 1;
			}
			// Friday
			else if( $day_of_week==5 ) {
				$weekly_orders['friday'] += 1;
			}
			// Saturday
			else {
				$weekly_orders['saturday'] += 1;
			}
		}
		
		return $weekly_orders;
	}
	
	/* Accepts an array parameter of the weekly orders. Returns the combined total
	 * for each day.
	 */
	public function weeklyOrdersTotal($weekly_orders) {
		$count = $weekly_orders['monday'];
		$count += $weekly_orders['tuesday'];
		$count += $weekly_orders['wednesday'];
		$count += $weekly_orders['thursday'];
		$count += $weekly_orders['friday'];
		$count += $weekly_orders['saturday'];
		$count += $weekly_orders['sunday'];
		
		return $count;
	}
	
	/* Monthly orders ********************************************************/
	
	// Get all of an admin's orders that were placed this month
	public function getMonthlyOrders(Admin $admin = null) {
		
		$orders_array = array();
		if( isset($admin) ) {
			$orders_query = $this->getOrdersFromAdmin($admin);
		} else {
			$orders_query = Order::all();
		}
		foreach( $orders_query as $order ) {
			$parsed = Carbon::parse($order->time_placed);
			
			if( $parsed->startOfMonth() == Carbon::now()->startOfMonth() ) {
				array_push( $orders_array, $order );
			}
		}
		$orders = collect($orders_array);
		return $orders;
	}
	
	// Returns an array containing the count of an admin's orders placed each
	// day of the month to be used for a table.
	public function monthlyOrdersArray(Admin $admin = null) {
		
		$monthly_orders = [
			'1' => 0,
			'2' => 0,
			'3' => 0,
			'4' => 0,
			'5' => 0,
			'6' => 0,
			'7' => 0,
			'8' => 0,
			'9' => 0,
			'10' => 0,
			'11' => 0,
			'12' => 0,
			'13' => 0,
			'14' => 0,
			'15' => 0,
			'16' => 0,
			'17' => 0,
			'18' => 0,
			'19' => 0,
			'20' => 0,
			'21' => 0,
			'22' => 0,
			'23' => 0,
			'24' => 0,
			'25' => 0,
			'26' => 0,
			'27' => 0,
			'28' => 0,
			'29' => 0,
			'30' => 0,
			'31' => 0,
		];
		if( isset($admin) ) {
			$orders = $this->getMonthlyOrders($admin);
		} else {
			$orders = $this->getMonthlyOrders();
		}
		
		foreach( $orders as $order ) {
			
			$parsed = Carbon::parse($order->time_placed);
			//dd($parsed->day);
			$monthly_orders[strval($parsed->day)] += 1;
		}
		return $monthly_orders;
	}
	
	/* Quarterly orders */
	
	// Get all of an admin's orders that were placed this quarter.
	public function getQuarterlyOrders(Admin $admin = null)
	{
		$orders_array = array();
		if( isset($admin) ) {
			$orders_query = $this->getOrdersFromAdmin($admin);
		} else {
			$orders_query = Order::all();
		}
		foreach( $orders_query as $order ) {
			$parsed = Carbon::parse($order->time_placed);
			
			if( $parsed->firstOfQuarter() == Carbon::now()->firstOfQuarter() ) {
				array_push( $orders_array, $order );
			}
		}
		$orders = collect($orders_array);
		return $orders;
	}
	
	// Returns an array of the count of admin's orders placed on each month
	// of the current quarter, to be used in a table.
	public function quarterlyOrdersArray(Admin $admin = null)
	{
		if( Carbon::now()->quarter == 1 ) {
			$quarterly_orders = [
				'jan' => 0,
				'feb' => 0,
				'mar' => 0,
			];
		} else if( Carbon::now()->quarter == 2 ) {
			$quarterly_orders = [
				'apr' => 0,
				'may' => 0,
				'jun' => 0,
			];
		} else if( Carbon::now()->quarter == 3 ) {
			$quarterly_orders = [
				'jul' => 0,
				'aug' => 0,
				'sep' => 0,
			];
		} else {
			$quarterly_orders = [
				'oct' => 0,
				'nov' => 0,
				'dec' => 0,
			];
		}
		$orders = $this->getQuarterlyOrders($admin);
		foreach( $orders as $order ) {

			$parsed = Carbon::parse($order->time_placed);
			//dd($parsed->month);
			if( $parsed->month == 1 ) {
				$quarterly_orders['jan'] += 1;
			}
			else if( $parsed->month == 2 ) {
				$quarterly_orders['feb'] += 1;
			}
			else if( $parsed->month == 3 ) {
				$quarterly_orders['mar'] += 1;
			}
			else if( $parsed->month == 4 ) {
				$quarterly_orders['apr'] += 1;
			}
			else if( $parsed->month == 5 ) {
				$quarterly_orders['may'] += 1;
			}
			else if( $parsed->month == 6 ) {
				$quarterly_orders['jun'] += 1;
			}
			else if( $parsed->month == 7 ) {
				$quarterly_orders['jul'] += 1;
			}
			else if( $parsed->month == 8 ) {
				$quarterly_orders['aug'] += 1;
			}
			else if( $parsed->month == 9 ) {
				$quarterly_orders['sep'] += 1;
			}
			else if( $parsed->month == 10 ) {
				$quarterly_orders['oct'] += 1;
			}
			else if( $parsed->month == 11 ) {
				$quarterly_orders['nov'] += 1;
			}
			else {
				$quarterly_orders['dec'] += 1;
			}
		}
		return $quarterly_orders;
	}
}