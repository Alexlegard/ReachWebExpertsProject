@extends('adminlte::page')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>My Restaurants</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="yellow-action-link">
				<a href="{{ url('admin/my-restaurants/create') }}">Add Restaurant</a>
			</div>
			
			<div class="restaurants">
				<ul>
					@foreach( $restaurants as $restaurant )
					<li>
						<a href="{{ url('admin/my-restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
					</li>
					@endforeach
				</ul>
			</div>
			
			@if (session('success_message'))
				<div class="alert alert-success">
					{{ session('success_message') }}
				</div>
			@endif
		</div>
	</div>
	
	{{ $restaurants->links() }}
</div>
@endsection