@extends('layouts.store-layout')

@section('content')

@component('components.breadcrumbs')
	<a href="/">Home</a>
	<i class="fas fa-arrow-right"></i>
	<a href="{{ url('restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
	<i class="fas fa-arrow-right"></i>
	<a href="{{ url('restaurants/'.$restaurant->id.'/dishes') }}">Dishes</a>
	<i class="fas fa-arrow-right"></i>
	<span>{{ $dish->name }}</span>
@endcomponent

<div class="row">
	<div class="col-md-12">
		<div class="top-panel">
			<h1>{{ $dish->name }}</h1>
			
			<p class="card-top-restaurant">{{ $restaurant->name }}</p>
			
			<p class="card-top-city">{{ $restaurant->address['city'] }}</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="dish-details">
			@if( isset($dish->image_external_url) )
			<div class="dish-details-image">
				<img src="{{ $dish->image_external_url }}" width="250" height="250">
			</div>
			@endif
			
			<div class="dish-details-info">
				<p>{{ $dish->description }}</p>
			
				@if($dish->on_sale)
				<p>Price: <del>{{ presentPrice($dish->price['amount']) }}</del> {{ presentPrice($dish->special_price['amount']) }}!</p>
				@else
				<p>Price: {{ presentPrice($dish->price['amount']) }}</p>
				@endif
				
				<p>Cuisine: {{ $dish->cuisine }}</p>
				
				
				<div>
					<form action="{{ route('cart.store') }}" method="post">
						@csrf
						
						<div id="form-group-row">
							<div>
								<label for="quantity">Quantity:</label>
							</div>
							<select name="quantity">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
						</div>
						
						<input type="hidden" name="id" value="{{ $dish->id }}">
						<input type="hidden" name="name" value="{{ $dish->name }}">
						@if( $dish->on_sale )
						<input type="hidden" name="price"
							value="{{ $dish->special_price['amount'] }}">
						@else
						<input type="hidden" name="price"
							value="{{ $dish->price['amount'] }}">
						@endif
						
						<button type="submit" class="add-to-cart-btn">
							Add to Cart
						</button>
					</form>
				</div>
				
				
				<ul class="more-info">
				@if( $dish->isbeverage == true )
					<li>Beverage</li>
				@endif
				@if( $dish->people_served > 1 )
					<li>People served: {{ $dish->people_served }}</li>
				@endif
				</ul>
			</div>
		</div>
	</div>
</div>




@endsection