@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				@if( count($users) == 0 )
				<h1>No users found</h1>
				@else
				<h1>Showing Users</h1>
				@endif
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="users">
				@if( count($users) >= 1 )
				<ul>
					@foreach( $users as $user )
					<li>
						<a href="{{ url('admin/users/'.$user->id) }}">{{ $user->name }}</a>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
	
	{{ $users->links() }}
</div>
@endsection