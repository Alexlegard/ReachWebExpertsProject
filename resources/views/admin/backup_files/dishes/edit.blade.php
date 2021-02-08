@extends('adminlte::page')

@section('content')

<div class="back-to-list-container">
	<a href="{{ url('/admin/dishes/'. $dish->id) }}" class="back-to-list-btn">Back to Dish</a>
</div>

<form class="content-form" method="post" action="{{ url('/admin/dishes/'. $dish->id) }}">
	@csrf
	@method('PATCH')
	<!--
	Form items needed:
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
				<input type="text" name="name" value="{{ $dish->name }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="description">Description:</label>
			</div>
			
			<div class="col-6">
				<input type="text" name="description" value="{{ $dish->description }}">
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="slug">Slug:</label>
			</div>
			
			<div class="col-6">
				<input type="text" name="slug" value="{{ $dish->slug }}">
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="pricecurrency">Price (currency):</label>
			</div>
			<div>
				<input type="text" name="pricecurrency" value="{{ $dish->price['currency'] }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="priceamount">Price (amount):</label>
			</div>
			<div>
				<input type="number" step="0.01" name="priceamount" value="{{ $dish->price['amount'] }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="cuisine">Cuisine:</label>
			</div>
			<div>
				<input type="text" name="cuisine" value="{{ $dish->cuisine }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="peopleserved">People served:</label>
			</div>
			<div>
				<input type="number" name="peopleserved" value="{{ $dish->people_served }}" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="isbeverage">Beverage?</label>
			</div>
			<select name="isbeverage">
				@if($dish->is_beverage == 'yes')
				<option value="yes" selected>Yes</option>
				<option value="no">No</option>
				@else
				<option value="yes">Yes</option>
				<option value="no" selected>No</option>
				@endif
			</select>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="isalcoholic">Alcoholic?</label>
			</div>
			<select name="isalcoholic">
				@if($dish->is_alcoholic == 'yes')
				<option value="yes" selected>Yes</option>
				<option value="no">No</option>
				@else
				<option value="yes">Yes</option>
				<option value="no" selected>No</option>
				@endif
			</select>
		</div>
		
		<div id="form-group-row">
			<div>
				<label for="image">Image:</label>
			</div>
			<div>
				<input type="file" name="image" />
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