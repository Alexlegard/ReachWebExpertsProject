@extends('layouts.store-layout')

<?php
$address = $restaurant->address['streetaddress'] . ', ' .
$restaurant->address['city'] . ', ' .
$restaurant->address['stateprovince'] . ', ' .
$restaurant->address['country'];

$dishesurl = url('restaurants/'.$restaurant->id.'/dishes');
?>

@section('js')
<script>
	function ConfirmDelete(){
		if(!confirm("Are you sure you want to delete this review?"))
		event.preventDefault();
	}
</script>

@endsection

@section('css')
<link href="{{ asset('css/showrestaurant.css') }}" rel="stylesheet">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">


<style>
div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>
@endsection

@section('content')

@component('components.breadcrumbs')
	<a href="/">Home</a>
	<i class="fas fa-arrow-right"></i>
	<span>{{ $restaurant->name }}</span>
@endcomponent
<div class="top-panel">
	<h1>{{ $restaurant->name }}</h1>

	<p class="card-top-cuisine">{{ $restaurant->cuisine[0] }}</p>
	
	<p class="card-top-city">{{ $restaurant->address['city'] }}</p>
</div>

<div class="container">

	@if(session()->has('errors'))
	<div class="alert alert-danger mt-3 mb-0">
		@foreach( $errors->all() as $message )
		<p>Error: {{ $message }}</p>
		@endforeach
	</div>
	@endif

	<div class="row">
		<div class="col-12">
			<div class="white-content-box">
				<div class="show-restaurant-logo">
					<img src="{{ $restaurant->image_external_url }}" width="100" height="100">
				</div>

				<div class="show-restaurant-details">
					<div>
						{{ $restaurant->description }}
					</div>
					<div>
						Address: {{ $address }}
					</div>
					<div class="yellow-action-link">
						<a href="{{ url('restaurants/'.$restaurant->id.'/dishes') }}">Shop</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-12">
			<div class="white-content-box">
				@if( count($reviews) == 1 )
				<h2>1 review</h2>
				@else
				<h2>{{ count($reviews) }} reviews</h2>
				@endif

				@auth
				<form class="review-form" method="post" action="/restaurants/{{ $restaurant->id }}/review">
					@csrf
					<h4>Post a Review</h4>
					
					<div>
						<textarea name="review" placeholder="What do you think..." cols="45"></textarea>
					</div>
					
					<div class="form-submit">
						<input type="submit" value="Post Review">
						<span class="stars">
							<input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
						    <label class="star star-5" for="star-5"></label>
						    <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
						    <label class="star star-4" for="star-4"></label>
						    <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
						    <label class="star star-3" for="star-3"></label>
						    <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
						    <label class="star star-2" for="star-2"></label>
						    <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
						    <label class="star star-1" for="star-1"></label>
						</span>
					</div>
				</form>
				@else
				<h4>Sign in or register to post a review.</h4>
				@endauth

				@foreach( $reviews as $review )

				<hr>

				<div class="review">
					
					<h5><a href="{{ url('user/'.$review->user->id) }}">{{ $review->user->name }}</a></h5>
					@if( $review->user == Auth()->user() )
					<form method="post" action="{{ url('reviews/'.$review->id.'/delete') }}">
						@csrf
						@method('DELETE')
						<div class="form-submit">
							<input type="submit" value="Delete" onclick="return ConfirmDelete();" />
						</div>
					</form>
					@endif
					<div class="user-review-subheader">
						@if( count($review->user->review) == 1 )
						<span>1 review</span>
						@else
						<span>{{ count($review->user->review) }} reviews</span>
						@endif
						<span>1 follower</span>
						<span>August 20, 2020</span>
					</div>

					<div class="user-review-star-rating">
						@for( $i = 0; $i < 5; $i++ )
							@if( $i < $review->rating )
								<span class="fa fa-star"></span>
							@else
								<span class="far fa-star"></span>
							@endif
						@endfor
					</div>
					<p>{{ $review->content }}</p>
				</div>
				@endforeach

				@endsection
			</div>
		</div>
	</div>
</div>




