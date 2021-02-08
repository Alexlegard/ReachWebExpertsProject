@extends('adminlte::page')

@section('content')

<div>
	<a href="{{ url('admin/restaurants/' . $restaurant->id) }}">Back</a>
</div>

<form class="content-form" method="post"
	action="/admin/dishes/{{ $restaurant->id }}" enctype="multipart/form-data">
	@csrf
	
	<div id="card-top">
		<h1>Add New Dish</h1>
	</div>
	
	<!--
	Name
	Price(JSON: Currency, and amount)
	Cuisine
	People served
	Is beverage
	Image
	All are required except image
	-->
	
	<div id="card-bottom">
		<div id="form-group-row">
			<div>
				<label for="name">Name:</label>
			</div>
			<div>
				<input type="text" name="name" />
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
				<label for="pricecurrency">Price (currency):</label>
			</div>
			<div>
				<input type="text" name="pricecurrency" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="priceamount">Price (amount):</label>
			</div>
			<div>
				<input type="number" step="0.01" name="priceamount" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="cuisine">Cuisine:</label>
			</div>
			<div>
				<input type="text" name="cuisine" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="calories">Calories:</label>
			</div>
			<div>
				<input type="number" name="calories" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="peopleserved">People served:</label>
			</div>
			<div>
				<input type="number" name="peopleserved" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="isbeverage">Beverage?</label>
			</div>
			<select name="isbeverage">
				<option value="yes">Yes</option>
				<option value="no" selected>No</option>
			</select>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="isalcoholic">Alcoholic?</label>
			</div>
			<select name="isalcoholic">
				<option value="yes">Yes</option>
				<option value="no" selected>No</option>
			</select>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="image">Image:</label>
			</div>
			<div>
				<input type="file" name="image" />
			</div>
			<div>
				{{ $errors->first('image') }}
			</div>
		</div>
		
		<div id="form-group-row">
			<input type="submit" value="Add Dish" />
		</div>
		
	</div>
</form>

@foreach( $errors->all() as $message )
	<p style="color:red;">Error: {{ $message }}</p>
@endforeach

@endsection







