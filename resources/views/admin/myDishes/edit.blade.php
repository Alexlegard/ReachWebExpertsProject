@extends('adminlte::page')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Editing {{ $dish->name }}</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="{{ url('/admin/my-dishes/'. $dish->id) }}">
				@csrf
				@method('PATCH')
				
				<div class="grey-nav-link">
					<a href="{{ url('/admin/my-dishes/'. $dish->id) }}" class="back-to-list-btn">Back to Dishes</a>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="name">Name:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="name" value="{{ $dish->name }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="description">Description:</label>
					</div>
					
					<div class="col-md-9">
						<input type="text" name="description" value="{{ $dish->description }}">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="slug">Slug:</label>
					</div>
					
					<div class="col-md-9">
						<input type="text" name="slug" value="{{ $dish->slug }}">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="pricecurrency">Price (currency):</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="pricecurrency" value="{{ $dish->price['currency'] }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="priceamount">Regular price:</label>
					</div>
					<div class="col-md-9">
						<input type="number" step="0.01" name="priceamount" value="{{ $dish->price['amount'] }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="specialprice">Special price:</label>
					</div>
					<div class="col-md-9">
						<input type="number" step="0.01" name="specialprice" value="{{ $dish->special_price['amount'] ?? '' }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="cuisine">Cuisine:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="cuisine" value="{{ $dish->cuisine }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="peopleserved">People served:</label>
					</div>
					<div class="col-md-9">
						<input type="number" name="peopleserved" value="{{ $dish->people_served }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="stock">Stock:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="stock" value="{{ $dish->stock }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="isbeverage">Beverage?</label>
					</div>
					<div class="col-md-9">
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
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="isalcoholic">Alcoholic?</label>
					</div>
					<div class="col-md-9">
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
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="image">Image:</label>
					</div>
					<div class="col-md-9">
						<input type="file" name="image" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-12">
						<div class="form-submit">
							<input type="submit" value="Edit Dish" />
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