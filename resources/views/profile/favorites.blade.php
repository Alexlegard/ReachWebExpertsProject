@extends('layouts.profile-layout')

@section('css')
<style>
.favorites {
	background-color:#cc0000;
}
</style>
@endsection

@section('content')
<div class="container">
	<div class="content-padding">
	</div>
	<div class="row">
		<div class="col-12">
			<div class="header-large-green">
				@if(! $restaurants->count() )
				<h1>You have no favorites</h1>
				@else
				<h1>Your Favorites</h1>
				@endif
			</div>
		</div>
	</div>
	
	<div class="row">
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
						
						<!-- Unfavorite form -->
						<form class="favorite-form" method="post" action="/unfavorite/{{ $restaurant->id }}">
							@csrf
							<input type="hidden" name="restaurantid" value="{{ $restaurant->id }}">
							<button class="button-naked" type="submit">
								<i class="fas fa-heart favorited"></i>
							</button>
						</form>
					</div>
				</div>
			</a>
		</div>
		@endforeach
	</div>
	
	{{ $restaurants->links() }}
</div>
@endsection