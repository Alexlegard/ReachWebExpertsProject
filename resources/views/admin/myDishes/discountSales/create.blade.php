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
				<span>Sale</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Put New Sale</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="/admin/my-dishes/{{$dish->id}}/sale">
				@csrf
				
				<!-- Need to fill out the form for special price and sale duration -->
				
				<div class="row">
					<div class="col-md-3">
						<label for="specialprice">Special price:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="specialprice" value="{{ $dish->special_price['amount'] }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="currency">Special price (currency):</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="currency" value="{{ $dish->special_price['currency'] }}" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="duration">Duration:</label>
					</div>
					<div class="col-md-9">
						<select name="duration">
							<option value="oneweek">1 week</option>
							<option value="twoweeks">2 weeks</option>
							<option value="threeweeks">3 weeks</option>
							<option value="onemonth">1 month</option>
							<option value="twomonths">2 months</option>
							<option value="threemonths">3 months</option>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-12">
						<div class="form-submit">
							<input type="submit" value="Put Sale" />
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