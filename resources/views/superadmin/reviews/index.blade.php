@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				@if( count($reviews) == 0 )
				<h1>No reviews found</h1>
				@else
				<h1>Showing reviews</h1>
				@endif
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="reviews">
				@if( count($reviews) >= 1 )
				<table class="details-table">
					@foreach( $restaurants as $restaurant )
						@if( isset($restaurant->review[0]) )
							
						<tr>
							<td>{{ $restaurant->name }}</td>
							
							<td>
								@foreach($restaurant->review as $review)
								<div>
									<a href="{{ url('admin/reviews/'.$review->id) }}">
										From {{ $review->user->name }} on {{ $review->time_submitted }}
									</a>
								</div>
								@endforeach
							</td>
						</tr>
							
						@endif
					@endforeach
				</table>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection