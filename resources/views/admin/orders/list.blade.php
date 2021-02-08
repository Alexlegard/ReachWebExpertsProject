@extends('adminlte::page')

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
<script>
var weeklyOrdersContext = document.querySelector('#weeklyOrdersChart').getContext('2d');
var monthlyOrdersContext = document.querySelector('#monthlyOrdersChart').getContext('2d');
var quarterlyOrdersContext = document.querySelector('#quarterlyOrdersChart').getContext('2d');

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
					{{ $weekly_orders['monday'] }},
					{{ $weekly_orders['tuesday'] }},
					{{ $weekly_orders['wednesday'] }},
					{{ $weekly_orders['thursday'] }},
					{{ $weekly_orders['friday'] }},
					{{ $weekly_orders['saturday'] }},
					{{ $weekly_orders['sunday'] }}
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
					{{ $monthly_orders['1'] }},
					{{ $monthly_orders['2'] }},
					{{ $monthly_orders['3'] }},
					{{ $monthly_orders['4'] }},
					{{ $monthly_orders['5'] }},
					{{ $monthly_orders['6'] }},
					{{ $monthly_orders['7'] }},
					{{ $monthly_orders['8'] }},
					{{ $monthly_orders['9'] }},
					{{ $monthly_orders['10'] }},
					{{ $monthly_orders['11'] }},
					{{ $monthly_orders['12'] }},
					{{ $monthly_orders['13'] }},
					{{ $monthly_orders['14'] }},
					{{ $monthly_orders['15'] }},
					{{ $monthly_orders['16'] }},
					{{ $monthly_orders['17'] }},
					{{ $monthly_orders['18'] }},
					{{ $monthly_orders['19'] }},
					{{ $monthly_orders['20'] }},
					{{ $monthly_orders['21'] }},
					{{ $monthly_orders['22'] }},
					{{ $monthly_orders['23'] }},
					{{ $monthly_orders['24'] }},
					{{ $monthly_orders['25'] }},
					{{ $monthly_orders['26'] }},
					{{ $monthly_orders['27'] }},
					{{ $monthly_orders['28'] }},
					{{ $monthly_orders['29'] }},
					{{ $monthly_orders['30'] }},
					{{ $monthly_orders['31'] }}
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
$keys = array_keys($quarterly_orders);
$values = array_values($quarterly_orders);
?>
var month1 = "{{ $keys[0] }}";
var month2 = "{{ $keys[1] }}";
var month3 = "{{ $keys[2] }}";
var value1 = "{{ $values[0] }}";
var value2 = "{{ $values[1] }}";
var value3 = "{{ $values[2] }}";

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
</script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<!-- Left column -->
		<div class="col-6">
			<div class="subheader-small-blue">
				@if(! isset($orders[0]) )
				<h4>You have no orders.</h4>
				@else
				<h4>List of Orders</h4>
				@endif
			</div>
		
			<table class="details-table">
				<tr>
					<th>Time placed</th>
					<th>Billing name</th>
					<th>Total</th>
					<th>Link</th>
				</tr>
				
				@foreach($orders as $order)
				<tr>
					<td>{{ $order->time_placed }}</td>
					<td>{{ $order->billing_name }}</td>
					<td>${{ $order->billing_total }}</td>
					<td>
						<a href="{{ url('admin/my-orders/'.$order->id) }}">Order</a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		
		<!-- Right column -->
		<div class="col-6">
			<div class="subheader-small-blue">
				<h4>Weekly orders</h4>
			</div>
			<canvas class="orders-chart" id="weeklyOrdersChart">
			</canvas>
			
			<div class="subheader-small-blue">
				<h4>Orders from {{ $month }}</h4>
			</div>
			<canvas class="orders-chart" id="monthlyOrdersChart">
			</canvas>
			
			<div class="subheader-small-blue">
				<h4>Orders from {{ $quarter }}</h4>
			</div>
			<canvas class="orders-chart" id="quarterlyOrdersChart">
			</canvas>
		</div>
	</div>
</div>
@endsection




