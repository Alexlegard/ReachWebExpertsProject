@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Showing Order</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
	
		<!-- Left column -->
		<div class="col-6">
			<table class="details-table">
				<tr>
					<td>Time placed</td>
					<td>{{ $order->time_placed }}</td>
				</tr>
				<tr>
					<td>Customer name</td>
					<td>{{ $order->billing_name }}</td>
				</tr>
				<tr>
					<td>Customer email</td>
					<td>{{ $order->billing_email }}</td>
				</tr>
				<tr>
					<td>Street address</td>
					<td>{{ $order->billing_streetaddress }}</td>
				</tr>
				<tr>
					<td>City</td>
					<td>{{ $order->billing_city }}</td>
				</tr>
				<tr>
					<td>State / Province</td>
					<td>{{ $order->billing_state_province }}</td>
				</tr>
				<tr>
					<td>Country</td>
					<td>{{ $order->billing_country }}</td>
				</tr>
				<tr>
					<td>Postal code</td>
					<td>{{ $order->billing_postalcode }}</td>
				</tr>
				<tr>
					<td>Name on card</td>
					<td>{{ $order->billing_name_on_card }}</td>
				</tr>
				<tr>
					<td>Subtotal</td>
					<td>{{ presentPrice($order->billing_subtotal) }}</td>
				</tr>
				<tr>
					<td>Tax</td>
					<td>{{ presentPrice($order->billing_tax) }}</td>
				</tr>
				<tr>
					<td>Total</td>
					<td>{{ presentPrice($order->billing_total) }}</td>
				</tr>
				<tr>
					<td>Payment gateway</td>
					<td>{{ $order->payment_gateway }}</td>
				</tr>
				<tr>
					<td>Shipped</td>
					@if( $order->shipped )
					<td>Yes</td>
					@else
					<td>No</td>
					@endif
				</tr>
			</table>
		</div>
		
		<!-- Right column -->
		<div class="col-6">
			<div class="grey-nav-link">
				<a href="{{ url('admin/orders') }}">Back to orders</a>
			</div>
		</div>
	</div>
	
	<hr>
	
	<div class="row">
		<div class="col-6">
			<h4>This orders dishes</h4>
			
			<ul>
				@foreach( $dishes as $dish )
				<li>
					<a href="{{ url('admin/dishes/'.$dish->id) }}">{{ $dish->name }}</a>
				</li>
				@endforeach
			</ul>
		</div>
		
		<div class="col-6">
			<h4>This order's restaurants</h4>
			
			<ul>
				@foreach( $restaurants as $restaurant )
				<li>
					<a href="{{ url('admin/restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection