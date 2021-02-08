<?php

namespace App\Traits;
use App\Charts\SalesChart;
use Carbon\Carbon;

trait MakeSalesCharts {
	
	/* Accepts an array containing the table data */
	public function makeWeeklySalesChart($weekly_sales)
	{
		$weeklySalesChart = new SalesChart;
		$weeklySalesChart->labels([
			'Mon', 'Tues', 'Wed', 'Thurs',
			'Fri', 'Sat', 'Sun'
		]);
		$dataset = $weeklySalesChart->dataset('Sales', 'bar', [
			$weekly_sales['monday'],
			$weekly_sales['tuesday'],
			$weekly_sales['wednesday'],
			$weekly_sales['thursday'],
			$weekly_sales['friday'],
			$weekly_sales['saturday'],
			$weekly_sales['sunday'],
		]);
		$dataset->backgroundColor('#FF4500');
		return $weeklySalesChart;
	}
	
	/* Accepts an array containing the table data */
	public function makeMonthlySalesChart($monthly_sales)
	{
		$monthlySalesChart = new SalesChart;
		$monthlySalesChart->labels([
			'1', '2', '3', '4', '5',
			'6', '7', '8', '9', '10',
			'11', '12', '13', '14', '15',
			'16', '17', '18', '19', '20',
			'21', '22', '23', '24', '25',
			'26', '27', '28', '29', '30',
			'31'
		]);
		$dataset = $monthlySalesChart->dataset('Sales', 'line', [
			$monthly_sales['1'],
			$monthly_sales['2'],
			$monthly_sales['3'],
			$monthly_sales['4'],
			$monthly_sales['5'],
			$monthly_sales['6'],
			$monthly_sales['7'],
			$monthly_sales['8'],
			$monthly_sales['9'],
			$monthly_sales['10'],
			$monthly_sales['11'],
			$monthly_sales['12'],
			$monthly_sales['13'],
			$monthly_sales['14'],
			$monthly_sales['15'],
			$monthly_sales['16'],
			$monthly_sales['17'],
			$monthly_sales['18'],
			$monthly_sales['19'],
			$monthly_sales['20'],
			$monthly_sales['21'],
			$monthly_sales['22'],
			$monthly_sales['23'],
			$monthly_sales['24'],
			$monthly_sales['25'],
			$monthly_sales['26'],
			$monthly_sales['27'],
			$monthly_sales['28'],
			$monthly_sales['29'],
			$monthly_sales['30'],
			$monthly_sales['31'],
		]);
		$dataset->backgroundColor('#1E90FF');
		return $monthlySalesChart;
	}
	
	public function makeQuarterlySalesChart($monthly_sales)
	{
		$quarterlySalesChart = new SalesChart;
		
		if( Carbon::now()->quarter == 1 ) {
			$quarterlySalesChart->labels([
				'Jan', 'Feb', 'Mar'
			]);
			$dataset = $quarterlySalesChart->dataset('Sales', 'bar', [
				$monthly_sales['jan'],
				$monthly_sales['feb'],
				$monthly_sales['mar']
			]);
		} else if( Carbon::now()->quarter == 2 ) {
			$quarterlySalesChart->labels([
				'Apr', 'May', 'Jun'
			]);
			$dataset = $quarterlySalesChart->dataset('Sales', 'bar', [
				$monthly_sales['apr'],
				$monthly_sales['may'],
				$monthly_sales['jun']
			]);
		} else if( Carbon::now()->quarter == 3 ) {
			$quarterlySalesChart->labels([
				'Jul', 'Aug', 'Sep'
			]);
			$dataset = $quarterlySalesChart->dataset('Sales', 'bar', [
				$monthly_sales['jul'],
				$monthly_sales['aug'],
				$monthly_sales['sep']
			]);
		} else {
			$quarterlySalesChart->labels([
				'Oct', 'Nov', 'Dec'
			]);
			$dataset = $quarterlySalesChart->dataset('Sales', 'bar', [
				$monthly_sales['oct'],
				$monthly_sales['nov'],
				$monthly_sales['dec']
			]);
		}
		$dataset->backgroundColor('green');
		return $quarterlySalesChart;
	}
}








