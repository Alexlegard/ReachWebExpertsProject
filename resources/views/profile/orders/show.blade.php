@extends('layouts.profile-layout')

@section('css')
<style>
.orders {
	background-color:#cc0000;
}
</style>
@endsection

@section('content')
<div class="container">
	<div class="content-padding">
	</div>

	<div class="white-content-box">
		<div class="row">
			<div class="col-12">
				<div class="header-large-green">
					<h1>Order Details</h1>
				</div>
				<table class="details-table">
					<tr>
						<td>Name on card</td>
						<td>{{ $order->billing_name_on_card }}</td>
					</tr>
					<tr>
						<td>Shipped</td>
						@if( $order->shipped )
						<td>Yes</td>
						@else
						<td>No</td>
						@endif
					</tr>
					<tr>
						<td>Time placed</td>
						<td>{{ $order->time_placed }}</td>
					</tr>
					<tr>
						<td>Billing address</td>
						<td>{{ getOrderBillingAddress($order) }}</td>
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
				</table>

				<div class="header-large-green">
					<h1>Order Items</h1>
				</div>

				<table class="details-table">
					<tr>
						<th>Quantity</th>
						<th>Name</th>
					</tr>
					@foreach($order->dishes as $dish)
					<tr>
						<td>{{ $dish->pivot->quantity }}</td>
						<td>{{ $dish->name }}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>
@endsection