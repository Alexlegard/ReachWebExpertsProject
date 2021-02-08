@extends('layouts.store-layout')

<?php
function getAddress($restaurant) {
	
	$addressSet = isset(
		$restaurant->address['streetaddress'],
		$restaurant->address['city'],
		$restaurant->address['stateprovince'],
		$restaurant->address['country']
	);
	if($addressSet) {
		$restaurant_address = implode(', ', $restaurant->address);
		return $restaurant_address;
	}
	return null;
}
?>

@section('content')

@component('components.breadcrumbs')
	<a href="/">Home</a>
	<i class="fa fa-chevron-right breadcrumb-separator"></i>
	<span>Search</span>
@endcomponent

<div class="top-panel">
	@if( $restaurants->count() == 1 )
	<h1>1 result for {{ request()->input('query') }}</h1>
	@else
	<h1>{{ $restaurants->count() }} results for {{ request()->input('query') }}</h1>
	@endif
</div>

<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="search-container container">
					
				@foreach($restaurants as $restaurant)
				<div class="col-md-6">
					<a href="{{ url('restaurants/'.$restaurant->id) }}">
						<div class="welcome-restaurant-card">
							@if( isset($restaurant->image_external_url) )
							<div class="restaurant-card-logo">
								<img src="{{ url($restaurant->image_external_url) }}" width="100" height="100">
							</div>
							@endif
							<div class="restaurant-card-details">
								<div class="restaurant-card-name">
									{{ $restaurant->name }}
								</div>
								<div class="restaurant-card-address">
									{{ getAddress($restaurant) }}
								</div>
								@if( Auth::check() )
									@if($favorites->contains($restaurant->id))
									<!-- Favorited -->
									<form class="favorite-form" method="post" action="/unfavorite/{{ $restaurant->id }}">
										@csrf
										<input type="hidden" name="restaurantid" value="{{ $restaurant->id }}">
										<button class="button-naked" type="submit">
											<i class="fas fa-heart favorited"></i>
										</button>
									</form>
									@else
									<!-- Not favorited -->
									<form class="favorite-form" method="post" action="/favorite">
										@csrf
										<input type="hidden" name="restaurantid" value="{{ $restaurant->id }}">
										<button class="button-naked" type="submit">
											<i class="fas fa-heart not-favorited"></i>
										</button>
									</form>
									@endif
								@endif
							</div>
						</div>
					</a>
					
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>



@endsection