<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GetOrders;
use App\Traits\GetSales;
use App\Traits\MakeSalesCharts;
use Auth;
use Carbon\Carbon;

class SalesController extends Controller
{
	use GetOrders;
	use GetSales;
	use MakeSalesCharts;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		
		$admin = Auth::guard('admin')->user();
		$orders = $this->getOrdersFromAdmin($admin);
		
		// Daily sales
		$dailyOrders = $this->getTodaysOrders($admin);
		$dailySales = $this->getTodaysSales($admin);
		
		// Weekly sales
		$weekly_sales = $this->weeklySalesArray($admin);
		
		// Monthly sales
		$month = Carbon::now()->format('F Y');
		$monthly_sales = $this->monthlySalesArray($admin);
		
		// Quarterly sales
		$quarter = "Q" . Carbon::now()->quarter . " " . Carbon::now()->year;
		$quarterly_sales = $this->quarterlySalesArray($admin);
		
		
        return view("admin/sales/index", [
			'orders' => $orders,
			'dailySales' => $dailySales,
			'weekly_sales' => $weekly_sales,
			'month' => $month,
			'monthly_sales' => $monthly_sales,
			'quarter' => $quarter,
			'quarterly_sales' => $quarterly_sales
		]);
    }
}
