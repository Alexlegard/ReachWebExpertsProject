@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="breadcrumbs">
				<a href="{{ url('admin/my-restaurants') }}">Restaurants</a>
				<i class="fas fa-arrow-right"></i>
				<a href="{{ url('admin/my-restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
				<i class="fas fa-arrow-right"></i>
				<a href="{{ url('admin/my-dishes/'.$dish->id) }}">{{ $dish->name }}</a>
				<i class="fas fa-arrow-right"></i>
				<a href="{{ url('admin/my-selections/'.$selection->id) }}">{{ $selection->name }}</a>
				<i class="fas fa-arrow-right"></i>
				<span>Edit</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Editing {{ $selection->name }}</h1>
			</div>	
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="{{ url('admin/my-selections/'.$selection->id) }}">
			@csrf
			@method('PATCH')
		
			<!-- Name -->
			<div class="row">
				<div class="col-md-3">
					<label for="name">Name:</label>
				</div>
				<div class="col-md-9">
					<input type="text" name="name" value="{{ $selection->name }}" />
				</div>
			</div>
			
			<!-- Options -->
			<div class="row">
				<div class="col-md-3">
					<label for="options">Options:</label>
				</div>
				<div class="col-md-9">
					<div>
					<input type="text" name="options[]" />
				</div>
				<div>
					<input type="text" name="options[]" />
				</div>
				<div>
					<input type="text" name="options[]" />
				</div>
				<div>
					<input type="text" name="options[]" />
				</div>
				<div>
					<input type="text" name="options[]" />
				</div>
				<div>
					<input type="text" name="options[]" />
				</div>
				<div>
					<input type="text" name="options[]" />
				</div>
				<div>
					<input type="text" name="options[]" />
				</div>
				<div>
					<input type="text" name="options[]" />
				</div>
				<div>
					<input type="text" name="options[]" />
				</div>
				</div>
			</div>
			
			<!-- Number of options customer can choose? -->
			<div class="row">
				<div class="col-md-3">
					<label for="radiocheckbox">Customer can choose one or many options?</label>
				</div>
				<div class="col-md-9">
					<select name="radio_or_checkbox">
						@if( $selection->radio_or_checkbox == 'radio' )
						<option value="radio" selected>Select One</option>
						<option value="checkbox">Select Multiple</option>
						@else
						<option value="radio">Select One</option>
						<option value="checkbox" selected>Select Multiple</option>
						@endif
						
					</select>
				</div>
			</div>
			
			<div class="form-submit">
				<input type="submit" value="Edit Selection" />
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