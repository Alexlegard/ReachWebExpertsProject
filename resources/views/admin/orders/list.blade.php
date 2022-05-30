@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
<script>
var weeklyOrdersContext = document.querySelector('#weeklyOrdersChart').getContext('2d');
var weeklyRevenueContext = document.querySelector('#weeklyRevenueChart').getContext('2d');
var monthlyOrdersContext = document.querySelector('#monthlyOrdersChart').getContext('2d');
var monthlyRevenueContext = document.querySelector('#monthlyRevenueChart').getContext('2d');
var quarterlyOrdersContext = document.querySelector('#quarterlyOrdersChart').getContext('2d');
var quarterlyRevenueContext = document.querySelector('#quarterlyRevenueChart').getContext('2d');

let weeklyOrdersChart = new Chart(weeklyOrdersContext, {
	type: 'line',
	data: {
		labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
		datasets: [
			{
				label: "Orders",
				backgroundColor: "green",
				borderColor: "green",
				fill: false,
				
				data: [
					{{ $weekly_invoices[1] }},
					{{ $weekly_invoices[2] }},
					{{ $weekly_invoices[3] }},
					{{ $weekly_invoices[4] }},
					{{ $weekly_invoices[5] }},
					{{ $weekly_invoices[6] }},
					{{ $weekly_invoices[7] }}
				]
			}
		]
		
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					min: 0,
					suggestedMax: 10,
					stepSize: 1
				}
			}]
		}
	}
});

let weeklyRevenueChart = new Chart(weeklyRevenueContext, {
	type: 'line',
	data: {
		labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
		datasets: [
			{
				label: "Revenue",
				backgroundColor: "green",
				borderColor: "green",
				fill: false,
				
				data: [
					{{ $weekly_revenue[1] }},
					{{ $weekly_revenue[2] }},
					{{ $weekly_revenue[3] }},
					{{ $weekly_revenue[4] }},
					{{ $weekly_revenue[5] }},
					{{ $weekly_revenue[6] }},
					{{ $weekly_revenue[7] }}
				]
			}
		]
		
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					min: 0,
					suggestedMax: 10,
					stepSize: 1
				}
			}]
		}
	}
});

let monthlyOrdersChart = new Chart(monthlyOrdersContext, {
	type: 'line',
	data: {
		labels: [
			'1st', '2nd', '3rd', '4th', '5th',
			'6th', '7th', '8th', '9th', '10th',
			'11th', '12th', '13th', '14th', '15th',
			'16th', '17th', '18th', '19th', '20th',
			'21st', '22nd', '23rd', '24th', '25th',
			'26th', '27th', '28th', '29th', '30th',
			'31st'
		],
		datasets: [
			{
				label: "Orders",
				backgroundColor: "blue",
				borderColor: "blue",
				fill: false,
				
				data: [
					{{ $monthly_invoices['1'] }},
					{{ $monthly_invoices['2'] }},
					{{ $monthly_invoices['3'] }},
					{{ $monthly_invoices['4'] }},
					{{ $monthly_invoices['5'] }},
					{{ $monthly_invoices['6'] }},
					{{ $monthly_invoices['7'] }},
					{{ $monthly_invoices['8'] }},
					{{ $monthly_invoices['9'] }},
					{{ $monthly_invoices['10'] }},
					{{ $monthly_invoices['11'] }},
					{{ $monthly_invoices['12'] }},
					{{ $monthly_invoices['13'] }},
					{{ $monthly_invoices['14'] }},
					{{ $monthly_invoices['15'] }},
					{{ $monthly_invoices['16'] }},
					{{ $monthly_invoices['17'] }},
					{{ $monthly_invoices['18'] }},
					{{ $monthly_invoices['19'] }},
					{{ $monthly_invoices['20'] }},
					{{ $monthly_invoices['21'] }},
					{{ $monthly_invoices['22'] }},
					{{ $monthly_invoices['23'] }},
					{{ $monthly_invoices['24'] }},
					{{ $monthly_invoices['25'] }},
					{{ $monthly_invoices['26'] }},
					{{ $monthly_invoices['27'] }},
					{{ $monthly_invoices['28'] }},
					{{ $monthly_invoices['29'] }},
					{{ $monthly_invoices['30'] }},
					{{ $monthly_invoices['31'] }}
				]
			}
		]
		
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					min: 0,
					suggestedMax: 10,
					stepSize: 1
				}
			}]
		}
	}
});

let monthlyRevenueChart = new Chart(monthlyRevenueContext, {
	type: 'line',
	data: {
		labels: [
			'1st', '2nd', '3rd', '4th', '5th',
			'6th', '7th', '8th', '9th', '10th',
			'11th', '12th', '13th', '14th', '15th',
			'16th', '17th', '18th', '19th', '20th',
			'21st', '22nd', '23rd', '24th', '25th',
			'26th', '27th', '28th', '29th', '30th',
			'31st'
		],
		datasets: [
			{
				label: "Orders",
				backgroundColor: "blue",
				borderColor: "blue",
				fill: false,
				
				data: [
					{{ $monthly_revenue['1'] }},
					{{ $monthly_revenue['2'] }},
					{{ $monthly_revenue['3'] }},
					{{ $monthly_revenue['4'] }},
					{{ $monthly_revenue['5'] }},
					{{ $monthly_revenue['6'] }},
					{{ $monthly_revenue['7'] }},
					{{ $monthly_revenue['8'] }},
					{{ $monthly_revenue['9'] }},
					{{ $monthly_revenue['10'] }},
					{{ $monthly_revenue['11'] }},
					{{ $monthly_revenue['12'] }},
					{{ $monthly_revenue['13'] }},
					{{ $monthly_revenue['14'] }},
					{{ $monthly_revenue['15'] }},
					{{ $monthly_revenue['16'] }},
					{{ $monthly_revenue['17'] }},
					{{ $monthly_revenue['18'] }},
					{{ $monthly_revenue['19'] }},
					{{ $monthly_revenue['20'] }},
					{{ $monthly_revenue['21'] }},
					{{ $monthly_revenue['22'] }},
					{{ $monthly_revenue['23'] }},
					{{ $monthly_revenue['24'] }},
					{{ $monthly_revenue['25'] }},
					{{ $monthly_revenue['26'] }},
					{{ $monthly_revenue['27'] }},
					{{ $monthly_revenue['28'] }},
					{{ $monthly_revenue['29'] }},
					{{ $monthly_revenue['30'] }},
					{{ $monthly_revenue['31'] }}
				]
			}
		]
		
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					min: 0,
					suggestedMax: 10,
					stepSize: 1
				}
			}]
		}
	}
});

<?php
$keys = array_keys($quarterly_invoices);
$values = array_values($quarterly_invoices);
$revenueValues = array_values($quarterly_revenue);
?>
var quarterInt = "{{ $quarterInt }}";
var value1 = "{{ $values[0] }}";
var value2 = "{{ $values[1] }}";
var value3 = "{{ $values[2] }}";
var revenueValue1 = "{{ $revenueValues[0] }}";
var revenueValue2 = "{{ $revenueValues[1] }}";
var revenueValue3 = "{{ $revenueValues[2] }}";


if( quarterInt === "1" ) {
	var month1 = "Jan";
	var month2 = "Feb";
	var month3 = "Mar"
}

if( quarterInt === "2" ) {
	var month1 = "Apr";
	var month2 = "May";
	var month3 = "Jun"
}

if( quarterInt === "3" ) {
	var month1 = "Jul";
	var month2 = "Aug";
	var month3 = "Sep"
}

if( quarterInt === "4" ) {
	var month1 = "Oct";
	var month2 = "Nov";
	var month3 = "Dec"
}

let quarterlyOrdersChart = new Chart(quarterlyOrdersContext, {
	type: 'line',
	data: {
		labels: [
			month1,
			month2,
			month3
		],
		datasets: [
			{
				label: "Orders",
				backgroundColor: "purple",
				borderColor: "purple",
				fill: false,
				
				data: [
					value1,
					value2,
					value3
				]
			}
		]
		
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					min: 0,
					suggestedMax: 10,
					stepSize: 1
				}
			}]
		}
	}
});

let quarterlyRevenueChart = new Chart(quarterlyRevenueContext, {
	type: 'line',
	data: {
		labels: [
			month1,
			month2,
			month3
		],
		datasets: [
			{
				label: "Orders",
				backgroundColor: "purple",
				borderColor: "purple",
				fill: false,
				
				data: [
					revenueValue1,
					revenueValue2,
					revenueValue3
				]
			}
		]
		
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					min: 0,
					suggestedMax: 10,
					stepSize: 1
				}
			}]
		}
	}
});
</script>
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-6">
			<div class="subheader-small-blue">
				<h4>Weekly orders</h4>
			</div>
			<canvas class="orders-chart" id="weeklyOrdersChart">
			</canvas>
		</div>
		<div class="col-6">
			<div class="subheader-small-blue">
				<h4>Weekly Revenue</h4>
			</div>
			<canvas class="orders-chart" id="weeklyRevenueChart">
			</canvas>
		</div>
	</div>

	<div class="row">
		<div class="col-6">
			<div class="subheader-small-blue">
				<h4>Orders from {{ $month }}</h4>
			</div>
			<canvas class="orders-chart" id="monthlyOrdersChart">
			</canvas>
		</div>
		<div class="col-6">
			<div class="subheader-small-blue">
				<h4>Revenue from {{ $month }}</h4>
			</div>
			<canvas class="orders-chart" id="monthlyRevenueChart">
			</canvas>
		</div>
	</div>

	<div class="row">
		<div class="col-6">
			<div class="subheader-small-blue">
				<h4>Orders from {{ $quarter }}</h4>
			</div>
			<canvas class="orders-chart" id="quarterlyOrdersChart">
			</canvas>
		</div>
		<div class="col-6">
			<div class="subheader-small-blue">
				<h4>Revenue from {{ $quarter }}</h4>
			</div>
			<canvas class="orders-chart" id="quarterlyRevenueChart">
			</canvas>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="subheader-small-blue">
				@if(! isset($invoices[0]) )
				<h4>You have no orders.</h4>
				@else
				<h4>My Invoices</h4>
				@endif
			</div>
		
			<table class="details-table">
				<tr>
					<th>Time placed</th>
					<th>Billing name</th>
					<th>Total (No Tax)</th>
					<th>Total (Tax)</th>
				</tr>
				
				@foreach($invoices as $invoice)
				<tr>
					<td><a href="{{ url('admin/my-orders/'.$invoice->id) }}">{{ $invoice->time_issued }}</a></td>
					<td><a href="{{ url('admin/my-orders/'.$invoice->id) }}">{{ $invoice->customer_name_on_card }}</a></td>
					<td><a href="{{ url('admin/my-orders/'.$invoice->id) }}">{{ presentPrice($invoice->subtotal) }}</a></td>
					<td><a href="{{ url('admin/my-orders/'.$invoice->id) }}">{{ presentPrice($invoice->total) }}</a></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection