@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Add New Dish</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="/admin/my-dishes/{{ $restaurant->id }}" enctype="multipart/form-data">
				@csrf
				
				<div class="grey-nav-link">
					<a href="{{ url('admin/my-restaurants/' . $restaurant->id) }}">Back</a>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="name">Name:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="name" />
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
						<label for="pricecurrency">Price (currency):</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="pricecurrency" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="priceamount">Price (amount):</label>
					</div>
					<div class="col-md-9">
						<input type="number" step="0.01" name="priceamount" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="specialprice">Special price:</label>
					</div>
					<div class="col-md-9">
						<input type="number" step="0.01" name="specialprice" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="cuisine">Cuisine:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="cuisine" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="calories">Calories:</label>
					</div>
					<div class="col-md-9">
						<input type="number" name="calories" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="peopleserved">People served:</label>
					</div>
					<div class="col-md-9">
						<input type="number" name="peopleserved" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="stock">Stock:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="stock" />
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-md-3">
						<label for="isbeverage">Beverage?</label>
					</div>
					<div class="col-md-9">
						<select name="isbeverage">
							<option value="yes">Yes</option>
							<option value="no" selected>No</option>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="isalcoholic">Alcoholic?</label>
					</div>
					<div class="col-md-9">
						<select name="isalcoholic">
							<option value="yes">Yes</option>
							<option value="no" selected>No</option>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="image">Image:</label>
					</div>
					<div class="col-md-9">
						<input type="file" name="image" />
					</div>
					<div>
						{{ $errors->first('image') }}
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-submit">
							<input type="submit" value="Add Dish" />
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







