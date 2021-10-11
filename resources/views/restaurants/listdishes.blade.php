@extends('layouts.store-layout')

@section('content')

@component('components.breadcrumbs')
	<a href="/">Home</a>
	<i class="fas fa-arrow-right"></i>
	<a href="{{ url('restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
	<i class="fas fa-arrow-right"></i>
	<span>Dishes</span>
@endcomponent

<div class="top-panel">
	@if( isset($dishes[0]) )
	<h1>Showing dishes for {{ $restaurant->name }}</h1>
	@else
	<h1>No dishes found for {{ $restaurant->name }}</h1>
	@endif
</div>

<div class="container">
	<div class="row">
		@foreach( $restaurant->menu->dish as $dish )
		<div class="col-md-6">
			<a href="{{ url('dishes/'.$dish->id) }}">
				<div class="list-dish-card" dusk="dish-card">
					@if( isset($dish->image) )
					<div class="dish-card-image">
						<img src="{{ asset('storage/dishimages/'.$dish->image) }}" width="100" height="100">
					</div>
					@endif
					<div class="dish-card-details">
						<div class="dish-card-name">
							{{ $dish->name }}
						</div>
						<div class="dish-card-address">
							{{ $dish->description }}
						</div>
					</div>
				</div>
			</a>
		</div>
		@endforeach
	</div>

	{{ $dishes->links() }}
</div>
@endsection