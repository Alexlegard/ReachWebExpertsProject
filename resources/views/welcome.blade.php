@extends('layouts.store-layout')

@section('content')

@component('components.breadcrumbs')
	<a href="/">Home</a>
@endcomponent



<div class="top-panel">
	<h1>Need a restaurant?</h1>

	<h4>Find the perfect restaurant for you with our helpful listing.</h4>
</div>

<div class="container">
	<div class="row">
		@foreach($restaurants as $restaurant)
		<div class="col-md-6">
			<a href="{{ url('restaurants/'.$restaurant->slug) }}">
				<div class="welcome-restaurant-card" dusk="restaurant-card">
					@if( $restaurant->image )
					<div class="restaurant-card-logo">
						<img src="{{ asset('storage/restaurantimages/'.$restaurant->image) }}" width="100" height="100">
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
									<i class="fas fa-heart favorited" dusk="heart-favorited"></i>
								</button>
							</form>
							@else
							<!-- Not favorited -->
							<form class="favorite-form" method="post" action="/favorite">
								@csrf
								<input type="hidden" name="restaurantid" value="{{ $restaurant->id }}">
								<button class="button-naked" type="submit">
									<i class="fas fa-heart not-favorited" dusk="heart-not-favorited"></i>
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
	
	{{ $restaurants->links() }}
</div>
@endsection