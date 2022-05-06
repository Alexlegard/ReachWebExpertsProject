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
use App\Traits\GetInvoices;
use App\Charts\OrdersChart;
use App\Traits\MakeOrdersCharts;
use Carbon\Carbon;

class OrdersController extends Controller
{
	use GetDishes;
	use GetRestaurants;
	use GetOrders;
	use GetInvoices;
	use MakeOrdersCharts;
    /**
     * Display a listing of the invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	// Simplest way to go is to make a new trait like getInvoices...
    	// We need to pass arrays of INTEGERS to be used by chartjs.
        // for charts showing the NUMBER of orders:
    	// weekly_invoices, monthly_invoices, and quarterly_invoices.
        // for charts showing the REVENUE:
        // weekly_revenue, monthly_revenue, quarterly_revenue

		$admin = Auth::guard('admin')->user();

		$invoices = $admin->invoices;

		// Today's invoices
		$dailyInvoices = $this->getTodaysInvoices($admin);

		// This week's invoices
		$weeklyInvoices = $this->getWeeklyInvoices($admin);

		// This month's invoices
		$month = Carbon::now()->format('F Y');
		$monthlyInvoices = $this->getMonthlyInvoices($admin);

		// This quarter's invoices
		$quarter = "Q" . Carbon::now()->quarter . " " . Carbon::now()->year;
        $quarterInt = Carbon::now()->quarter;
		$quarterlyInvoices = $this->getQuarterlyInvoices($admin);

        // Today's revenue
        $dailyRevenue = $this->getTodaysRevenue($admin);

        // This week's revenue
        $weeklyRevenue = $this->getWeeklyRevenue($admin);

        // This month's revenue
        $monthlyRevenue = $this->getMonthlyRevenue($admin);

        // This quarter's revenue
        $quarterlyRevenue = $this->getQuarterlyRevenue($admin);
		
		return view("admin/orders/list", [
			'invoices'           => $invoices,
			'dailyInvoices'      => $dailyInvoices,
            'dailyRevenue'       => $dailyRevenue,
			'weekly_invoices'    => $weeklyInvoices,
            'weekly_revenue'     => $weeklyRevenue,
			'month'              => $month,
			'monthly_invoices'   => $monthlyInvoices,
            'monthly_revenue'    => $monthlyRevenue,
			'quarter'            => $quarter,
            'quarterInt'         => $quarterInt,
			'quarterly_invoices' => $quarterlyInvoices,
            'quarterly_revenue'  => $quarterlyRevenue
		]);
    }

    /**
     * Display the specified invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Auth::guard('admin')->user();
        $invoice = $admin->invoices->where('id', $id)->first();

        // Get dishes from the pivot table.

		$dishes = $invoice->dishes;
		
		return view("admin/orders/show", [
			'invoice' => $invoice,
			'dishes' => $dishes,
		]);
    }

    /**
     * Show the form for editing the specified invoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified invoice in storage.
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
     * Remove the specified invoice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
