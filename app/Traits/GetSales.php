<?php

namespace App\Traits;

use App\Admin;
use App\Sale;
use Carbon\Carbon;
use App\Order;

trait GetSales {
	
	use GetOrders;
	
	public function getSalesFromAdmin(Admin $admin)
	{
		//dd($admin->restaurants[0]->menu->dish[0]->orders[0]->sale);
		$sales_array = array();
		
		foreach($admin->restaurants as $restaurant) {
			foreach($restaurant->menu->dish as $dish) {
				foreach($dish->orders as $order) {
					array_push($sales_array, $order->sale);
				}
			}
		}
		$sales = collect($sales_array);
		return $sales;
	}
	
	public function getTodaysSales(Admin $admin = null)
	{
		$salesTotal = 0;
		$orders_query;
		
		if( isset($admin) ) {
			$orders_query = $this->getOrdersFromAdmin($admin);
		} else {
			$orders_query = Order::all();
		}
		foreach( $orders_query as $order ) {
			
			if( Carbon::parse($order->time_placed)->isToday() ) {
				$salesTotal += $order->billing_total;
				$salesTotal -= $order->billing_commission;
			}
		}
		return $salesTotal;
	}
	
	/* Weekly sales */
	
	// Returns an array containing the admin's revenue for each day
	// of the week, to be used for a table
	public function weeklySalesArray(Admin $admin = null)
	{
		$weekly_sales = [
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
		
		foreach( $orders as $order ) {
			
			$day_of_week = Carbon::parse($order->time_placed)->dayOfWeek;
			
			// Sunday
			if( $day_of_week==0 ) {
				$weekly_sales['sunday'] += $order->billing_total;
				$weekly_sales['sunday'] -= $order->billing_commission;
			}
			// Monday
			else if( $day_of_week==1 ) {
				$weekly_sales['monday'] += $order->billing_total;
				$weekly_sales['monday'] -= $order->billing_commission;
			}
			// Tuesday
			else if( $day_of_week==2 ) {
				$weekly_sales['tuesday'] += $order->billing_total;
				$weekly_sales['tuesday'] -= $order->billing_commission;
			}
			// Wednesday
			else if( $day_of_week==3 ) {
				$weekly_sales['wednesday'] += $order->billing_total;
				$weekly_sales['wednesday'] -= $order->billing_commission;
			}
			// Thursday
			else if( $day_of_week==4 ) {
				$weekly_sales['thursday'] += $order->billing_total;
				$weekly_sales['thursday'] -= $order->billing_commission;
			}
			// Friday
			else if( $day_of_week==5 ) {
				$weekly_sales['friday'] += $order->billing_total;
				$weekly_sales['friday'] -= $order->billing_commission;
			}
			// Saturday
			else {
				$weekly_sales['saturday'] += $order->billing_total;
				$weekly_sales['saturday'] -= $order->billing_commission;
			}
		}
		
		return $weekly_sales;
	}
	
	/* Accepts an array containing the weekly sales data and returns the total for the week. */
	public function weeklySalesTotal($weekly_sales)
	{
		$count = $weekly_sales['monday'];
		$count += $weekly_sales['tuesday'];
		$count += $weekly_sales['wednesday'];
		$count += $weekly_sales['thursday'];
		$count += $weekly_sales['friday'];
		$count += $weekly_sales['saturday'];
		$count += $weekly_sales['sunday'];
		
		return $count;
	}
	
	/* Monthly sales */
	
	// Returns an array  containing the admin's revenue for each day of the week,
	// to be used for the table...
	public function monthlySalesArray(Admin $admin = null)
	{
		$monthly_sales = [
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
			$monthly_sales[strval($parsed->day)] += $order->billing_total;
			$monthly_sales[strval($parsed->day)] -= $order->billing_commission;
		}
		return $monthly_sales;
	}
	
	/* Quarterly sales */
	
	// Returns an array containing the admin's revenue for the quarter, to be 
	// used for the chart...
	public function quarterlySalesArray(Admin $admin = null)
	{
		if( Carbon::now()->quarter == 1 ) {
			$quarterly_sales = [
				'jan' => 0,
				'feb' => 0,
				'mar' => 0,
			];
		} else if( Carbon::now()->quarter == 2 ) {
			$quarterly_sales = [
				'apr' => 0,
				'may' => 0,
				'jun' => 0,
			];
		} else if( Carbon::now()->quarter == 3 ) {
			$quarterly_sales = [
				'jul' => 0,
				'aug' => 0,
				'sep' => 0,
			];
		} else {
			$quarterly_sales = [
				'oct' => 0,
				'nov' => 0,
				'dec' => 0,
			];
		}
		if( isset($admin) ) {
			$orders = $this->getQuarterlyOrders($admin);
		} else {
			$orders = $this->getQuarterlyOrders();
		}
		
		foreach( $orders as $order ) {
			
			$parsed = Carbon::parse($order->time_placed);
			
			if( $parsed->month == 1 ) {
				$quarterly_sales['jan'] += $order->billing_total;
				$quarterly_sales['jan'] -= $order->billing_commission;
			}
			else if( $parsed->month == 2 ) {
				$quarterly_sales['feb'] += $order->billing_total;
				$quarterly_sales['feb'] -= $order->billing_commission;
			}
			else if( $parsed->month == 3 ) {
				$quarterly_sales['mar'] += $order->billing_total;
				$quarterly_sales['mar'] -= $order->billing_commission;
			}
			else if( $parsed->month == 4 ) {
				$quarterly_sales['apr'] += $order->billing_total;
				$quarterly_sales['apr'] -= $order->billing_commission;
			}
			else if( $parsed->month == 5 ) {
				$quarterly_sales['may'] += $order->billing_total;
				$quarterly_sales['may'] -= $order->billing_commission;
			}
			else if( $parsed->month == 6 ) {
				$quarterly_sales['jun'] += $order->billing_total;
				$quarterly_sales['jun'] -= $order->billing_commission;
			}
			else if( $parsed->month == 7 ) {
				$quarterly_sales['jul'] += $order->billing_total;
				$quarterly_sales['jul'] -= $order->billing_commission;
			}
			else if( $parsed->month == 8 ) {
				$quarterly_sales['aug'] += $order->billing_total;
				$quarterly_sales['aug'] -= $order->billing_commission;
			}
			else if( $parsed->month == 9 ) {
				$quarterly_sales['sep'] += $order->billing_total;
				$quarterly_sales['sep'] -= $order->billing_commission;
			}
			else if( $parsed->month == 10 ) {
				$quarterly_sales['oct'] += $order->billing_total;
				$quarterly_sales['oct'] -= $order->billing_commission;
			}
			else if( $parsed->month == 11 ) {
				$quarterly_sales['nov'] += $order->billing_total;
				$quarterly_sales['nov'] -= $order->billing_commission;
			}
			else {
				$quarterly_sales['dec'] += $order->billing_total;
				$quarterly_sales['dec'] -= $order->billing_commission;
			}
		}
		return $quarterly_sales;
	}
}





















