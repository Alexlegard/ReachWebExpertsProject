@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Editing {{ $restaurant->name }}</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="{{ url('/admin/my-restaurants/'. $restaurant->id) }}" enctype="multipart/form-data">
				@csrf
				@method('PATCH')
				
				
				<div class="grey-nav-link">
					<a href="{{ url('/admin/my-restaurants/'. $restaurant->id) }}">
						Back to Restaurant
					</a>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="title">Title:</label>
					</div>
					
					<div class="col-md-9">
						<input type="text" name="title" value="{{ $restaurant->name }}">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="description">Description:</label>
					</div>
					
					<div class="col-md-9">
						<input type="text" name="description" value="{{ $restaurant->description }}">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="slug">Slug:</label>
					</div>
					
					<div class="col-md-9">
						<input type="text" name="slug" value="{{ $restaurant->slug }}">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="streetaddress">Street address:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="streetaddress" value="{{ $restaurant->address['streetaddress'] }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="streetaddresstwo">Street address line 2:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="streetaddresstwo" value="{{ isset($restaurant->address['streetaddresstwo']) ?: '' }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="city">City:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="city" value="{{ $restaurant->address['city'] }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="stateprovince">State / Province:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="stateprovince" value="{{ $restaurant->address['stateprovince'] }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="country">Country:</label>
					</div>
					<div class="col-md-9">
						<select name="country">
							@if($restaurant->address['country'] == 'Canada') {
							<option value="Canada" selected>Canada</option>
							<option value="United States">United States</option>
							@elseif($restaurant->address['country'] == 'United States')
							<option value="Canada">Canada</option>
							<option value="United States" selected>United States</option>
							@endif
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="cuisine">Cuisine:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="cuisine[]" value="{{ $restaurant->cuisine[0] }}" />
						<input type="text" name="cuisine[]" value="{{ $restaurant->cuisine[1] }}" />
						<input type="text" name="cuisine[]" value="{{ $restaurant->cuisine[2] }}" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label for="image">Restaurant image:</label>
					</div>
					<div class="col-md-9">
						<input type="file" name="image" />
					</div>
				</div>
				
				<div class="row">
					<div class="form-submit">
						<input type="submit" value="Edit Restaurant">
					</div>
				</div>
				
			</form>
		</div>
	</div>
	
	@if(session()->has('errors'))
	<div class="alert alert-danger mt-3">
		@foreach( $errors->all() as $message )
			<p>Error: {{ $message }}</p>
		@endforeach
	</div>
	@endif
</div>

@endsection