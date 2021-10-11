@extends('layouts.store-layout')

@section('content')
<div class="top-panel">
	<h1>{{ $user->name }}</h1>

	<div class="user-avatar">
		<img class="user-avatar-icon-public-profile" src="{{ asset('storage/useravatars/'.$user->avatar) }}" width="100" height="100">
	</div>

	@if( Auth()->check() )
		@if( $user->id != Auth()->user()->id )
			@if( Auth()->user()->followings->contains($user->id) )
			<!-- Unfollow form -->
			<form method="post" action="{{ url('user/'.$user->id.'/unfollow') }}">
				@csrf
				<div class="form-submit" style="text-align:center;">
					<input type="submit" value="Unfollow" dusk="unfollow">
				</div>
			</form>
			@else
			<!-- Follow form -->
			<form method="post" action="{{ url('user/'.$user->id.'/follow') }}">
				@csrf
				<div class="form-submit" style="text-align:center;">
					<input type="submit" value="Follow" dusk="follow">
				</div>
			</form>
			@endif
		@endif
	@endif
</div>


<div class="container">
	<div class="content-padding">
	</div>

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
				@if( count($user->review) == 0 )
				<div class="header">
					<h2>No reviews by {{ $user->name }}</h2>
				</div>
				@else
				<div class="header">
					<h2>Reviews from {{ $user->name }}</h2>
				</div>
				@endif

				@if( count($user->review) >= 1 )
				<div class="reviews">
					@foreach( $user->review as $review )

					<hr>

					<div class="review">
						<div class="user-review-subheader">
							<span><a href="{{ url('restaurants/'.$review->restaurant->id) }}">{{ $review->restaurant->name }}</a></span>
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
						<div class="user-review-content">
							{{ $review->content }}
						</div>
					</div>
					@endforeach
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection