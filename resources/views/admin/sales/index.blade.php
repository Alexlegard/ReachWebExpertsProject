@extends('adminlte::page')

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
<script>
var weeklySalesContext = document.querySelector('#weeklySalesChart').getContext('2d');
var monthlySalesContext = document.querySelector('#monthlySalesChart').getContext('2d');
var quarterlySalesContext = document.querySelector('#quarterlySalesChart').getContext('2d');



let weeklySalesChart = new Chart(weeklySalesContext, {
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
					{{ $weekly_sales['monday'] }},
					{{ $weekly_sales['tuesday'] }},
					{{ $weekly_sales['wednesday'] }},
					{{ $weekly_sales['thursday'] }},
					{{ $weekly_sales['friday'] }},
					{{ $weekly_sales['saturday'] }},
					{{ $weekly_sales['sunday'] }}
				]
			}
		]
		
	},
	options: {
		tooltips: {
			callbacks: {
				label: function(t, d) {
				   var xLabel = d.datasets[t.datasetIndex].label;
				   var yLabel = t.yLabel >= 1000 ? '$' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '$' + t.yLabel;
				   return xLabel + ': ' + yLabel;
				}
			}
		},
		
		scales: {
			yAxes: [{
				ticks: {
					min: 0,
					suggestedMax: 10,
					stepSize: 1,
					
				}
			}]
		}
	}
});

let monthlySalesChart = new Chart(monthlySalesContext, {
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
				label: "Revenue",
				backgroundColor: "blue",
				borderColor: "blue",
				fill: false,
				
				data: [
					{{ $monthly_sales['1'] }},
					{{ $monthly_sales['2'] }},
					{{ $monthly_sales['3'] }},
					{{ $monthly_sales['4'] }},
					{{ $monthly_sales['5'] }},
					{{ $monthly_sales['6'] }},
					{{ $monthly_sales['7'] }},
					{{ $monthly_sales['8'] }},
					{{ $monthly_sales['9'] }},
					{{ $monthly_sales['10'] }},
					{{ $monthly_sales['11'] }},
					{{ $monthly_sales['12'] }},
					{{ $monthly_sales['13'] }},
					{{ $monthly_sales['14'] }},
					{{ $monthly_sales['15'] }},
					{{ $monthly_sales['16'] }},
					{{ $monthly_sales['17'] }},
					{{ $monthly_sales['18'] }},
					{{ $monthly_sales['19'] }},
					{{ $monthly_sales['20'] }},
					{{ $monthly_sales['21'] }},
					{{ $monthly_sales['22'] }},
					{{ $monthly_sales['23'] }},
					{{ $monthly_sales['24'] }},
					{{ $monthly_sales['25'] }},
					{{ $monthly_sales['26'] }},
					{{ $monthly_sales['27'] }},
					{{ $monthly_sales['28'] }},
					{{ $monthly_sales['29'] }},
					{{ $monthly_sales['30'] }},
					{{ $monthly_sales['31'] }},
				]
			}
		]
		
	},
	options: {
		tooltips: {
			callbacks: {
				label: function(t, d) {
				   var xLabel = d.datasets[t.datasetIndex].label;
				   var yLabel = t.yLabel >= 1000 ? '$' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '$' + t.yLabel;
				   return xLabel + ': ' + yLabel;
				}
			}
		},
		
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
$keys = array_keys($quarterly_sales);
$values = array_values($quarterly_sales);
?>
var month1 = "{{ $keys[0] }}";
var month2 = "{{ $keys[1] }}";
var month3 = "{{ $keys[2] }}";
var value1 = "{{ $values[0] }}";
var value2 = "{{ $values[1] }}";
var value3 = "{{ $values[2] }}";

let quarterlySalesChart = new Chart(quarterlySalesContext, {
	type: 'line',
	data: {
		labels: [
			month1,
			month2,
			month3
		],
		datasets: [
			{
				label: "Revenue",
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
		tooltips: {
			callbacks: {
				label: function(t, d) {
				   var xLabel = d.datasets[t.datasetIndex].label;
				   var yLabel = t.yLabel >= 1000 ? '$' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '$' + t.yLabel;
				   return xLabel + ': ' + yLabel;
				}
			}
		},
		
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
		<div class="col-md-6">
			<div class="subheader-small-blue">
				<h4>My Sales</h4>
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
		<div class="col-md-6">
			<div class="subheader-small-blue">
				<h4>Weekly sales</h4>
			</div>
			<canvas class="sales-chart" id="weeklySalesChart">
			</canvas>
			
			<div class="subheader-small-blue">
				<h4>Sales from {{ $month }}</h4>
			</div>
			<canvas class="sales-chart" id="monthlySalesChart">
			</canvas>
			
			<div class="subheader-small-blue">
				<h4>Sales from {{ $quarter }}</h4>
			</div>
			<canvas class="sales-chart" id="quarterlySalesChart">
			</canvas>
		</div>
	</div>
</div>
@endsection