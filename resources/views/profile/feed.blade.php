@extends('layouts.profile-layout')

@section('css')
<style>
.review-subtitle {
	color:grey;
}
</style>
@endsection

@section('content')
<div class="container">
	<div class="content-padding">
	</div>

	<div class="row">
		<div class="col-12">
			<div class="white-content-box">
				<div class="header-large-green">
					<h1>Your Feed</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="white-content-box">

				<h4>Recent reviews</h4>
				

				@foreach($recent_reviews as $review)
				<hr>
				<div class="review">
					<div class="review-subtitle">
						<span><a href="{{ url('user/'.$user->id) }}">{{ $review->user->name }}</a></span>
						on <span><a href="{{ url('restaurants/'.$review->restaurant->id) }}">{{ $review->restaurant->name }}</a></span>
						<span>{{ $review->time_submitted }}</span>
					</div>
					<div class="review-content">
						{{ $review->content }}
					</div>
				</div>
				@endforeach
				<div>
					{{ $recent_reviews->links() }}
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="white-content-box">
				<h4>People You Follow</h4>

				<ul>
					@foreach( $followings as $following )
					<li><a href="{{ url('user/'.$user->id) }}">{{ $following->name }}</a></li>
					@endforeach
				</ul>

			</div>
		</div>
	</div>
</div>
@endsection