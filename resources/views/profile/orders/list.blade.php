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
					<h1>Your Orders</h1>
				</div>

				@if(! isset($user->orders[0]) )
				<div>You have not placed any orders.</div>
				@else
				<table class="details-table">
					<tr>
						<th>Price</th>
						<th>Date</th>
						<th>Status</th>
						<th>View</th>
					</tr>
					
					@foreach( $user->orders as $order )
					<tr>
						<td>${{ $order->billing_total }}</td>
						<td>{{ $order->time_placed }}</td>
						@if( $order->shipped )
						<td>Shipped</td>
						@else
						<td>Not shipped</td>
						@endif
						<td>
							<div class="grey-nav-link">
								<a href="{{ url('profile/orders/'.$order->id) }}">View Order</a>
							</div>
						</td>
					</tr>
					@endforeach
				</table>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection