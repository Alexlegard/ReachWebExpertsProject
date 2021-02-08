@extends('adminlte::page')

@section('content')
	<h1>List of users:</h1>
	
	<ul>
		@foreach($users as $user)
			<li>
				<a href="{{ url('admin/users/' . $user->id) }}">
					{{ $user->name }}
				</a>
			
			</li>
		@endforeach
	</ul>
@endsection