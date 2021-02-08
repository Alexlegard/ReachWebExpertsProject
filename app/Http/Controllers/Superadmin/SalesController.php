<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Traits\GetOrders;
use App\Traits\GetSales;
use App\Traits\MakeSalesCharts;
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
        $orders = Order::paginate(20);
		
		// Daily sales
		$dailySales = $this->getTodaysSales();
		
		// Weekly sales
		$weekly_sales = $this->weeklySalesArray();
		
		// Monthly sales
		$month = Carbon::now()->format('F Y');
		$monthly_sales = $this->monthlySalesArray();
		
		// Quarterly sales
		$quarter = "Q" . Carbon::now()->quarter . " " . Carbon::now()->year;
		$quarterly_sales = $this->quarterlySalesArray();
		
		return view("superadmin/sales/index", [
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
