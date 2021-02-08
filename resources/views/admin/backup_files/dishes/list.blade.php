@extends('adminlte::page')

@section('content')
	<h1>List of dishes:</h1>
	
	<ul>
		@foreach($dishes as $dish)
			<li>
				<a href="{{ url('admin/dishes/' . $dish->id) }}">
					{{ $dish->name }}
				</a>
			
			</li>
		@endforeach
	</ul>
@endsection