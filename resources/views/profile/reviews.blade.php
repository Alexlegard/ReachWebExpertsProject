@extends('layouts.profile-layout')

@section('css')
<style>
.reviews {
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
				@if( isset($reviews[0]) )
				<div class="subheader-large-green">
					<h2>Your Reviews</h2>
				</div>
				@else
				<div class="header-large-green">
					<h1>You have not posted any reviews.</h1>
				</div>
				@endif

				@if( isset($reviews[0]) )
				<table class="details-table">
					<tr>
						<th>Posted on</th>
						<th>Time posted</th>
						<th>Content</th>
						
					</tr>
					@foreach($reviews as $review)
					<tr>
						<td>
							<div class="grey-nav-link">
								<a href="{{ url('restaurants/'.$review->restaurant->id) }}">{{ $review->restaurant->name }}</a>
							</div>
						</td>
						<td>{{ $review->created_at }}</td>
						<td>{{ $review->content }}</td>
					</tr>
					@endforeach
				</table>
				@endif
			</div>
		</div>
		
		{{ $reviews->links() }}

	</div>
</div>
@endsection