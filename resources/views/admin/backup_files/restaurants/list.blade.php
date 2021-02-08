@extends('adminlte::page')

@section('content')
	<h1>List of restaurants:</h1>
	
	<a href="{{ url('admin/restaurants/create') }}">Add restaurant</a>
	
	
	
	
	@if( isset($restaurants[0]) )
		
	<ul>
		@foreach($restaurants as $restaurant)
			<li>
				<a href="{{ url('admin/restaurants/' . $restaurant->id) }}">
					{{ $restaurant->name }}
				</a>
			
			</li>
		@endforeach
	</ul>
	@endif
@endsection