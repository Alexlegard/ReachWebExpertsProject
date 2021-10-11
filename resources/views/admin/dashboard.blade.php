@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
<script>
var ordersContext = document.querySelector('#orders-graph').getContext('2d');
var salesContext = document.querySelector('#sales-graph').getContext('2d');

let ordersChart = new Chart(ordersContext, {
	type: 'line',
	data: {
		labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
		datasets: [
			{
				label: "Orders",
				borderColor:"green",
				backgroundColor:"green",
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

let salesChart = new Chart(salesContext, {
	type: 'line',
	data: {
		labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
		datasets: [
			{
				label: "Revenue",
				borderColor:"green",
				backgroundColor:"green",
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
					stepSize: 1
				}
			}]
		}
	}
});
</script>
@endsection

@section('css')
<style>
#weekly-orders, #weekly-sales {
	display:flex;
	flex-direction:row;
	flex-wrap:nowrap;
	justify-content:space-between;
}
</style>
@endsection

@section('content')

<div class="container">
	
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Welcome {{ $user->name }}</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			<div class="p-3 mb-2 bg-success text-white" id="weekly-orders">
				<div>
					Weekly Orders
				</div>
				<div>
					{{ $weekly_orders_total }}
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="p-3 mb-2 bg-success text-white" id="weekly-sales">
				<div>
					Weekly Sales
				</div>
				<div>
					{{ presentPrice($weekly_sales_total) }}
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="row">
		<!-- Left column -->
		<div class="col-md-6">
			<canvas width="600" height="400" id="orders-graph">
			</canvas>
		</div>
		
		<!-- Right column -->
		<div class="col-md-6">
			<canvas width="600" height="400" id="sales-graph">
			</canvas>
		</div>
	</div>
</div>

@endsection