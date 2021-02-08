<?php

namespace App\Traits;
use App\Charts\OrdersChart;
use Carbon\Carbon;

use Auth;


trait MakeOrdersCharts {
	
	
	
	/* Accepts an array containing the table data */
	public function makeWeeklyOrdersChart()
	{
		$admin = Auth::guard('admin')->user();
		$weekly_orders = $this->weeklyOrdersArray($admin);
		
		$weeklyOrdersChart = new OrdersChart;
		$weeklyOrdersChart->labels(['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun']);
		$dataset = $weeklyOrdersChart->dataset('Orders', 'bar', [
			$weekly_orders['monday'],
			$weekly_orders['tuesday'],
			$weekly_orders['wednesday'],
			$weekly_orders['thursday'],
			$weekly_orders['friday'],
			$weekly_orders['saturday'],
			$weekly_orders['sunday'],
		]);
		$dataset->backgroundColor('#FF4500');
		return $weeklyOrdersChart;
	}
	
	/* Accepts an array containing the table data */
	public function makeMonthlyOrdersChart($monthly_orders)
	{
		$monthlyOrdersChart = new OrdersChart;
		$monthlyOrdersChart->labels([
			'1', '2', '3', '4', '5',
			'6', '7', '8', '9', '10',
			'11', '12', '13', '14', '15',
			'16', '17', '18', '19', '20',
			'21', '22', '23', '24', '25',
			'26', '27', '28', '29', '30',
			'31',
		]);
		$dataset = $monthlyOrdersChart->dataset('orders', 'line', [
			$monthly_orders['1'],
			$monthly_orders['2'],
			$monthly_orders['3'],
			$monthly_orders['4'],
			$monthly_orders['5'],
			$monthly_orders['6'],
			$monthly_orders['7'],
			$monthly_orders['8'],
			$monthly_orders['9'],
			$monthly_orders['10'],
			$monthly_orders['11'],
			$monthly_orders['12'],
			$monthly_orders['13'],
			$monthly_orders['14'],
			$monthly_orders['15'],
			$monthly_orders['16'],
			$monthly_orders['17'],
			$monthly_orders['18'],
			$monthly_orders['19'],
			$monthly_orders['20'],
			$monthly_orders['21'],
			$monthly_orders['22'],
			$monthly_orders['23'],
			$monthly_orders['24'],
			$monthly_orders['25'],
			$monthly_orders['26'],
			$monthly_orders['27'],
			$monthly_orders['28'],
			$monthly_orders['29'],
			$monthly_orders['30'],
			$monthly_orders['31'],
		]);
		$dataset->backgroundColor('#1E90FF');
		return $monthlyOrdersChart;
	}
	
	/* Accepta an array containing the table data */
	public function makeQuarterlyOrdersChart($monthly_orders)
	{
		$quarterlyOrdersChart = new OrdersChart;
		
		if( Carbon::now()->quarter == 1 ) {
			$quarterlyOrdersChart->labels([
				'Jan', 'Feb', 'Mar'
			]);
			$dataset = $quarterlyOrdersChart->dataset('Orders', 'bar', [
				$monthly_orders['jan'],
				$monthly_orders['feb'],
				$monthly_orders['mar'],
			]);
			
		} else if( Carbon::now()->quarter == 2 ) {
			$quarterlyOrdersChart->labels([
				'Apr', 'May', 'Jun'
			]);
			$dataset = $quarterlyOrdersChart->dataset('Orders', 'bar', [
				$monthly_orders['apr'],
				$monthly_orders['may'],
				$monthly_orders['jun'],
			]);
		} else if( Carbon::now()->quarter == 3 ) {
			$quarterlyOrdersChart->labels([
				'Jul', 'Aug', 'Sep'
			]);
			$dataset = $quarterlyOrdersChart->dataset('Orders', 'bar', [
				$monthly_orders['jul'],
				$monthly_orders['aug'],
				$monthly_orders['sep'],
			]);
		} else {
			$quarterlyOrdersChart->labels([
				'Oct', 'Nov', 'Dec'
			]);
			$dataset = $quarterlyOrdersChart->dataset('Orders', 'bar', [
				$monthly_orders['oct'],
				$monthly_orders['nov'],
				$monthly_orders['dec'],
			]);
		}
		$dataset->backgroundColor('green');
		return $quarterlyOrdersChart;
	}
}