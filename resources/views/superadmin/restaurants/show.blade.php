@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('js')
<script>
	function ConfirmDelete(){
		if(!confirm("Are you sure you want to delete this restaurant?"))
		event.preventDefault();
	}
</script>
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Showing {{ $restaurant->name }}</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<!-- Left column -->
		<div class="col-6">
			<div>{{ $restaurant->description }}</div>
			
			<table class="details-table">
				<tr>
					<td>Address</td>
					<td>{{ $address }}</td>
				</tr>
				<tr>
					<td>Cuisine</td>
					<td>
						@foreach($restaurant->cuisine as $cuisine)
						<div>{{ $cuisine }}</div>
						@endforeach
					</td>
				</tr>
				<tr>
					<td>Commission</td>
					<td>{{ $restaurant->commission }}%</td>
				</tr>
				<tr>
					<td>Slug</td>
					<td>{{ $restaurant->slug }}</td>
				</tr>
				<tr>
					<td>Facebook</td>
					@if( isset($restaurant->facebook) )
					<td>
						<a href="{{ url($restaurant->facebook) }}">{{ $restaurant->facebook }}</a>
					</td>
					@else
					<td>Not set</td>
					@endif
				</tr>
				<tr>
					<td>Twitter</td>
					@if( isset($restaurant->twitter) )
					<td>
						<a href="{{ url($restaurant->twitter) }}">{{ $restaurant->twitter }}</a>
					</td>
					@else
					<td>Not set</td>
					@endif
				</tr>
				<tr>
					<td>Instagram</td>
					@if( isset($restaurant->instagram) )
					<td>
						<a href="{{ url($restaurant->instagram) }}">{{ $restaurant->instagram }}</a>
					</td>
					@else
					<td>Not set</td>
					@endif
				</tr>
			</table>
		</div>
		
		<!-- Right column -->
		<div class="col-6">
			<div class="links">
				<div class="grey-nav-link">
					<a href="{{ url('admin/restaurants') }}">Back to restaurants</a>
				</div>
				<form class="delete-form" method="post" action="{{ url('admin/restaurants/'. $restaurant->id) }}">
					@csrf
					@method('DELETE')
					<input type="submit" value="Delete this restaurant" onclick="return ConfirmDelete();">
				</form>
			</div>
		</div>
	</div>
	
	<hr>
	
	<div class="row">
		<!-- Left column -->
		<div class="col-6">
			<div class="restaurant-orders">
				<div class="restaurant-orders-header">
					@if( count($orders) == 0 )
					<h4>No orders at {{ $restaurant->name }}</h4>
					@elseif( count($orders) == 1 )
					<h4>{{ count($orders) }} order at {{ $restaurant->name }}:</h4>
					@else
					<h4>{{ count($orders) }} orders at {{ $restaurant->name }}:</h4>
					@endif
				</div>
				@if( count($orders) >= 1 )
				<div class="restaurant-orders-list">
					<ul>
					@foreach($orders as $order)
						<li>
							<a href="{{ url('admin/my-orders/'.$order->id) }}">{{ $order->time_placed }}</a>
						</li>
					@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
		<!-- Right column -->
		<div class="col-6">
			<div class="restaurant-dishes">
				<div class="restaurant-dishes-header">
					@if( count($restaurant->menu->dish) == 0 )
					<h4>No dishes offered at {{ $restaurant->name }}</h4>
					@elseif( count($restaurant->menu->dish) == 1 )
					<h4>1 dish offered at {{ $restaurant->name }}:</h4>
					@else
					<h4>{{ count($restaurant->menu->dish) }} dishes offered at {{ $restaurant->name }}:</h4>
					@endif
				</div>
				<div class="restaurant-dishes-list">
					<ul>
						@foreach($restaurant->menu->dish as $dish)
						<li>
							<a href="{{ url('admin/dishes/'.$dish->id) }}">{{ $dish->name }}</a>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-12">
			<div class="restaurant-reviews">
				<div class="restaurant-reviews-header">
					@if( count($reviews) == 0 )
					<h4>No reviews for {{ $restaurant->name }}</h4>
					@elseif( count($reviews) == 1 )
					<h4>{{ count($reviews) }} review for {{ $restaurant->name }}:</h4>
					@else
					<h4>{{ count($reviews) }} reviews for {{ $restaurant->name }}:</h4>
					@endif
				</div>
				@if( count($reviews) >= 1 )
				<div class="restaurant-reviews-list">
					<ul>
					@foreach($reviews as $review)
						<li>
							<a href="{{ url('admin/reviews/'.$review->id) }}">{{ $review->time_submitted }}</a>
						</li>
					@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection