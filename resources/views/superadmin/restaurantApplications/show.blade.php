@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')

<div class="container">
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
					<td>
						<img src="{{ asset('storage/restaurantimages/'.$restaurantApplication->image) }}" width="100" height="100">
					</td>
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
</div>






	
	
	
	
	

@endsection