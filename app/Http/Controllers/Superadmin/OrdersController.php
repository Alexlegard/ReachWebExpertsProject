<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Traits\GetDishes;
use App\Traits\GetRestaurants;
use App\Traits\GetOrders;
use App\Traits\MakeOrdersCharts;

use Carbon\Carbon;

class OrdersController extends Controller
{
	use GetDishes;
	use GetRestaurants;
	use GetOrders;
	use MakeOrdersCharts;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$orders = Order::paginate(20);
		
		// Daily orders
		$dailyOrders  = $this->getTodaysOrders();
		
		// Weekly orders
		$weekly_orders = $this->weeklyOrdersArray();
		
		// Monthly orders
		$month = Carbon::now()->format('F Y');
		$monthly_orders = $this->monthlyOrdersArray();
		
		// Quarterly orders
		$quarter = "Q" . Carbon::now()->quarter . " " . Carbon::now()->year;
		$quarterly_orders = $this->quarterlyOrdersArray();
		
        return view("superadmin/orders/list", [
			'orders' => $orders,
			'dailyOrders' => $dailyOrders,
			'weekly_orders' => $weekly_orders,
			'month' => $month,
			'monthly_orders' => $monthly_orders,
			'quarter' => $quarter,
			'quarterly_orders' => $quarterly_orders
		]);
    }
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
		$dishes = $this->getDishesFromOrder($order);
		$restaurants = $this->getRestaurantsFromOrder($order);
		
        return view("superadmin/orders/show", [
			'order' => $order,
			'dishes' => $dishes,
			'restaurants' => $restaurants
		]);
    }
}
