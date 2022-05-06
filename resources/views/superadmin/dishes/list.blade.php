@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<!-- Session message -->
	@if(Session::has('message'))
		<p class="alert
			{{ Session::get('alert-class', 'alert-info') }}">{{Session::get('message') }}
		</p>
	@endif
	
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				@if( count($dishes) == 0 )
				<h1>No dishes found.</h1>
				@else
				<h1>Showing dishes</h1>
				@endif
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			@if( count($dishes) >= 1 )
			<table class="details-table">
				@foreach( $restaurants as $restaurant )
					@if( count($restaurant->menu->dish) >= 1 )
					<tr>
						<td>
							<a href="{{ url('admin/restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
						</td>
						<td>
						@foreach($restaurant->menu->dish as $dish)
							<div>
								<a href="{{ url('admin/dishes/'.$dish->id) }}">{{ $dish->name }}</a>
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
@endsection