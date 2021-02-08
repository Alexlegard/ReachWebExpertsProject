@extends('adminlte::page')

@section('content')

<div>
	<a href="{{ url('admin/restaurants/' . $restaurant->id) }}">Back</a>
</div>

<form class="content-form" method="post"
	action="/admin/restaurants" enctype="multipart/form-data">
	@csrf
	
	<div id="card-top">
		<h1>Add New Restaurant</h1>
	</div>
	
	<div id="card-bottom">
		<div id="form-group-row">
			<div>
				<label for="title">Title:</label>
			</div>
			<div>
				<input type="text" name="title" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="description">Description:</label>
			</div>
			<div>
				<input type="text" name="description" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="slug">Slug:</label>
			</div>
			<div>
				<input type="text" name="slug" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="streetaddress">Street address:</label>
			</div>
			<div>
				<input type="text" name="streetaddress" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="streetaddresstwo">Street address line 2:</label>
			</div>
			<div>
				<input type="text" name="streetaddresstwo" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="city">City:</label>
			</div>
			<div>
				<input type="text" name="city" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="stateprovince">State / Province:</label>
			</div>
			<div>
				<input type="text" name="stateprovince" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="country">Country:</label>
			</div>
			<select name="country">
				<option value="Canada">Canada</option>
				<option value="United States">United States</option>
			</select>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="cuisine">Cuisine:</label>
			</div>
			<div>
				<input type="text" name="cuisine[]" />
				<input type="text" name="cuisine[]" />
				<input type="text" name="cuisine[]" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="image">Restaurant image:</label>
			</div>
			<div>
				<input type="file" name="image" />
			</div>
			<div>
				{{ $errors->first('image') }}
			</div>
		</div>
		
		<div id="form-group-row">
			<input type="submit" value="Add Restaurant" />
		</div>
		
	</div>
</form>

@foreach( $errors->all() as $message )
	<p style="color:red;">Error: {{ $message }}</p>
@endforeach

@endsection







