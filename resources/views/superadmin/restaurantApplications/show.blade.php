@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')

<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="breadcrumbs">
				<a href="{{ url('admin/restaurant-applications') }}">Restaurant Applications</a>
				<i class="fas fa-arrow-right"></i>
				<span>{{ $restaurantApplication->name }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Showing {{ $restaurantApplication->name }}</h1>
			</div>
			
			<div>{{ $restaurantApplication->description }}</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-6">
			<table class="details-table">
				
				<tr>
					<td>Admin name</td>
					<td>{{ $restaurantApplication->admin->name }}</td>
				</tr>
				<tr>
					<td>Slug</td>
					<td>{{ $restaurantApplication->slug }}</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>{{ $address }}</td>
				</tr>
				<tr>
					<td>Cuisines</td>
					<td>{{ $cuisines }}</td>
				</tr>
				<tr>
					<td>Image</td>
					@if( file_exists(public_path('/storage/restaurantapplicationimages/'.$restaurantApplication->image)) )
					<td>
						<img src="{{ asset('storage/restaurantapplicationimages/'.$restaurantApplication->image) }}" width="100" height="100">
					</td>
					@else
					<td>
						No image
					</td>
					@endif
					
				</tr>
			</table>
			@if (session('success_message'))
			<div class="alert alert-success">
				{{ session('success_message') }}
			</div>
			@endif
			
		</div>
		<div class="col-6">
			<div class="links">
				<form class="approve-form" method="post" action="{{ url('admin/restaurant-applications/'.$restaurantApplication->id.'/approve') }}">
					@csrf
					<input type="submit" value="Approve this restaurant">
				</form>
				<form class="deny-form" method="post" action="{{ url('admin/restaurant-applications/'.$restaurantApplication->id.'/deny') }}">
					@csrf
					@method('delete')
					<input type="submit" value="Deny this restaurant">
				</form>
			</div>
		</div>
	</div>

	@if(session()->has('errors'))
	<div class="alert alert-danger mt-3 mb-0">
		@foreach( $errors->all() as $message )
		<p>Error: {{ $message }}</p>
		@endforeach
	</div>
	@endif
</div>

@endsection