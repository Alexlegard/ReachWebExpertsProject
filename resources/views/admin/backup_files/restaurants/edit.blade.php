@extends('adminlte::page')

@section('content')

<div class="back-to-list-container">
	<a href="{{ url('/admin/restaurants/'. $restaurant->id) }}" class="back-to-list-btn">Back to Restaurant</a>
</div>

<form class="content-form" method="post" action="{{ url('/admin/restaurants/'. $restaurant->id) }}">
	@csrf
	@method('PATCH')
	
	<div id="card-top">
		<h1>Editing {{ $restaurant->name }}</h1>
	</div>
	
	<div id="card-bottom">
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="title">Title:</label>
			</div>
			
			<div class="col-6">
				<input type="text" name="title" value="{{ $restaurant->name }}">
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="description">Description:</label>
			</div>
			
			<div class="col-6">
				<input type="text" name="description" value="{{ $restaurant->description }}">
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="slug">Slug:</label>
			</div>
			
			<div class="col-6">
				<input type="text" name="slug" value="{{ $restaurant->slug }}">
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="streetaddress">Street address:</label>
			</div>
			<div>
				<input type="text" name="streetaddress" value="{{ $restaurant->address['streetaddress'] }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="streetaddresstwo">Street address line 2:</label>
			</div>
			<div>
				<input type="text" name="streetaddresstwo" value="{{ isset($restaurant->address['streetaddresstwo']) ?: '' }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="city">City:</label>
			</div>
			<div>
				<input type="text" name="city" value="{{ $restaurant->address['city'] }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="stateprovince">State / Province:</label>
			</div>
			<div>
				<input type="text" name="stateprovince" value="{{ $restaurant->address['stateprovince'] }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="country">Country:</label>
			</div>
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
		
		<div id="form-group-row">
			<div>
				<label for="cuisine">Cuisine:</label>
			</div>
			<div>
				<input type="text" name="cuisine[]" value="{{ $restaurant->cuisine[0] }}" />
				<input type="text" name="cuisine[]" value="{{ $restaurant->cuisine[1] }}" />
				<input type="text" name="cuisine[]" value="{{ $restaurant->cuisine[2] }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<input type="submit" value="Edit Restaurant">
		</div>
	</div>
</form>

@foreach( $errors->all() as $message )
	<p style="color:red;">Error: {{ $message }}</p>
@endforeach
	
@endsection