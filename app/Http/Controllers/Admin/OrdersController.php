<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Dish;
use Auth;
use App\Traits\GetDishes;
use App\Traits\GetRestaurants;
use App\Traits\GetOrders;
use App\Charts\OrdersChart;
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
		
		
		$admin = Auth::guard('admin')->user();
		$orders = $this->getOrdersFromAdmin($admin);
		
		// Number of today's orders
		$dailyOrders = $this->getTodaysOrders($admin);
		
		// Weekly orders
		$weekly_orders = $this->weeklyOrdersArray($admin);
		
		// Monthly orders
		$month = Carbon::now()->format('F Y');
		$monthly_orders = $this->monthlyOrdersArray($admin);
		
		// Quarterly orders
		$quarter = "Q" . Carbon::now()->quarter . " " . Carbon::now()->year;
		$quarterly_orders = $this->quarterlyOrdersArray($admin);
		
		
		return view("admin/orders/list", [
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
    public function show($id)
    {
        $order = Order::where('id', $id)->first();
		$dishes = $this->getDishesFromOrder($order);
		$restaurants = $this->getRestaurantsFromOrder($order);
		
		return view("admin/orders/show", [
			'order' => $order,
			'dishes' => $dishes,
			'restaurants' => $restaurants
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
