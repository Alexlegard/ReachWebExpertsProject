@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Restaurant Applications</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<ul>
				@foreach( $restaurantApplications as $restaurantApplication )
				<li>
					<a href="{{ url('admin/restaurant-applications/'.$restaurantApplication->id) }}">{{ $restaurantApplication->name }}</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	
	{{ $restaurantApplications->links() }}
	
	@if (session('success_message'))
	<div class="row">
		<div class="col-12">
			<div class="alert alert-success">
				{{ session('success_message') }}
			</div>
		</div>
	</div>
	@endif
</div>
@endsection