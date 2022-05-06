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
		<div class="col-6">
			<table class="details-table">
				<tr>
					<td>Time placed</td>
					<td>{{ $invoice->time_issued }}</td>
				</tr>
				<tr>
					<td>Customer Email</td>
					<td>{{ $invoice->customer_email }}</td>
				</tr>
				<tr>
					<td>Customer Name</td>
					<td>{{ $invoice->customer_name }}</td>
				</tr>
				<tr>
					<td>Customer Street Address</td>
					<td>{{ $invoice->customer_streetaddress . $invoice->customer_streetaddresstwo }}</td>
				</tr>
				<tr>
					<td>Customer City</td>
					<td>{{ $invoice->customer_city }}</td>
				</tr>
				<tr>
					<td>Customer State / Province</td>
					<td>{{ $invoice->customer_state_province }}</td>
				</tr>
				<tr>
					<td>Customer Country</td>
					<td>{{ $invoice->customer_country }}</td>
				</tr>
				<tr>
					<td>Customer Postal Code</td>
					<td>{{ $invoice->customer_postalcode }}</td>
				</tr>
				<tr>
					<td>Customer Name on Card</td>
					<td>{{ $invoice->customer_name_on_card }}</td>
				</tr>
				<tr>
					<td>Subtotal</td>
					<td>{{ presentPrice($invoice->subtotal) }}</td>
				</tr>
				<tr>
					<td>Tax</td>
					<td>{{ presentPrice($invoice->tax) }}</td>
				</tr>
				<tr>
					<td>Total</td>
					<td>{{ presentPrice($invoice->total) }}</td>
				</tr>
				<tr>
					<td>Commission</td>
					<td>{{ presentPrice($invoice->commission) }}</td>
				</tr>
				<tr>
					<td>Shipped</td>
					@if( $invoice->shipped )
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
				<a href="{{ url('admin/my-orders') }}">Back to Invoices</a>
			</div>
		</div>
	</div>
	
	<hr>
	
	<div class="row">
		<div class="col-6">
			<h4>This order's dishes:</h4>
			
			<table class="details-table">
				<tr>
					<th>Dish name</th>
					<th>Quantity</th>
				</tr>
				@foreach( $dishes as $dish )
				<tr>
					<td>
						<a href="{{ url('admin/my-dishes/'.$dish->id) }}">{{ $dish->name }}</a>
					</td>
					<td>{{ $dish->pivot->quantity }}</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection