@extends('adminlte::page')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Add New Restaurant</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="/admin/restaurant-applications" enctype="multipart/form-data">
				@csrf
				
				<p>Apply to add a new restaurant by filling out the form. The website
				owner will review your application.</p>
				
				<div class="grey-nav-link">
					<a href="{{ url('admin/my-restaurants') }}">Back to my restaurants</a>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="title">Title:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="title" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="description">Description:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="description" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="slug">Slug:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="slug" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="streetaddress">Street address:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="streetaddress" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="streetaddresstwo">Street address line 2:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="streetaddresstwo" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="city">City:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="city" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="stateprovince">State / Province:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="stateprovince" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="country">Country:</label>
					</div>
					<div class="col-md-9">
						<select name="country">
							<option value="Canada">Canada</option>
							<option value="United States">United States</option>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="cuisine">Cuisine:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="cuisine[]" />
						<input type="text" name="cuisine[]" />
						<input type="text" name="cuisine[]" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="image">Restaurant image:</label>
					</div>
					<div class="col-md-9">
						<input type="file" name="image" />
					</div>
					<div>
						{{ $errors->first('image') }}
					</div>
				</div>
				
				<div class="row">
					<div class="col-12">
						<div class="form-submit">
							<input type="submit" value="Add Restaurant" />
						</div>
					</div>
				</div>
			</form>
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