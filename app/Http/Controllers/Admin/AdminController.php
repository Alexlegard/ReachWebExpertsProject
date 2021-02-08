<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Traits\GetOrders;
use App\Traits\GetDishes;
use App\Traits\GetSales;
use Carbon\Carbon;
use App\Order;
use App\Charts\SalesChart;
use DB;
use App\Sale;
use App\Traits\MakeOrdersCharts;
use Charts;

class AdminController extends Controller
{
	use GetOrders;
	use GetDishes;
	use MakeOrdersCharts;
	use GetSales;
	
    public function dashboard()
	{
		if( Auth::guard('admin')->check() ) {
			
			$admin = Auth::guard('admin')->user();
			$orders = $this->getOrdersFromAdmin($admin);
			$dishes = $this->getDishesFromAdmin($admin);
			$recent_orders = $orders->where('time_placed', '>', Carbon::now()->subWeeks(1));
			
			// Weekly orders
			$weekly_orders = $this->weeklyOrdersArray($admin);
			$weekly_orders_total = $this->weeklyOrdersTotal($weekly_orders);
			
			// Weekly sales
			$weekly_sales = $this->weeklySalesArray($admin);
			$weekly_sales_total = $this->weeklySalesTotal($weekly_sales);
				  
				  
			return view('admin/dashboard', [
				'user' => auth::guard('admin')->user(),
				'dishes' => $dishes,
				'orders' => $orders,
				'recent_orders' => $recent_orders,
				'weekly_orders' => $weekly_orders,
				'weekly_orders_total' => $weekly_orders_total,
				'weekly_sales' => $weekly_sales,
				'weekly_sales_total' => $weekly_sales_total
			]);
		}
		/* Don't delete */
		if( Auth::guard('superadmin')->check() ) {
			
			$superadmin = Auth::guard('superadmin')->user();
			
			// Weekly orders
			$weekly_orders = $this->weeklyOrdersArray();
			$weekly_orders_total = $this->weeklyOrdersTotal($weekly_orders);
			
			// Weekly sales
			$weekly_sales = $this->weeklySalesArray();
			$weekly_sales_total = $this->weeklySalesTotal($weekly_sales);
			
			return view('admin/dashboard', [
				'user' => auth::guard('superadmin')->user(),
				'weekly_orders' => $weekly_orders,
				'weekly_orders_total' => $weekly_orders_total,
				'weekly_sales' => $weekly_sales,
				'weekly_sales_total' => $weekly_sales_total
			]);
		}
	}
	
	public function login()
	{
		return view('admin/auth/login');
	}
	
	public function showLogoutPage()
	{
		return view('admin/auth/logout');
	}
}
