@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('js')
<script>
function ConfirmDelete(){
	if(!confirm("Are you sure you want to delete this dish?"))
	event.preventDefault();
}
</script>
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="breadcrumbs">
				<a href="{{ url('admin/restaurants') }}">Restaurants</a>
				<i class="fas fa-arrow-right"></i>
				<a href="{{ url('admin/restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
				<i class="fas fa-arrow-right"></i>
				<span>{{ $dish->name }}</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Showing {{ $dish->name }}</h1>
			</div>
			
			<div>{{ $dish->menu->restaurant->name }}</div>
		
			<div>{{ $dish->description }}</div>
		</div>
	</div>
	
	<div class="row">
		<!-- Left column -->
		<div class="col-6">
			<table class="details-table">
				<tr>
					<td>Price</td>
					<td>{{ $dish->price['currency'] }} ${{ $dish->price['amount'] }}</td>
				</tr>
				<tr>
					<td>Special price</td>
					@if(! isset($dish->special_price['currency']) )
					<td>Not set</td>
					@else
					<td>{{ $dish->special_price['currency'] }} ${{ $dish->special_price['amount'] }}</td>
					@endif
				</tr>
				<tr>
					<td>Slug</td>
					<td>{{ $dish->slug }}</td>
				</tr>
				<tr>
					<td>Cuisine</td>
					<td>{{ $dish->cuisine }}</td>
				</tr>
				<tr>
					<td>Calories</td>
					@if(! isset($dish->calories) )
					<td>Not set</td>
					@else
					<td>{{ $dish->calories }}</td>
					@endif
				</tr>
				<tr>
					<td>Number people served</td>
					<td>{{ $dish->people_served }}</td>
				</tr>
				<tr>
					<td>Stock</td>
					<td>{{ $dish->stock }}</td>
				</tr>
				<tr>
					<td>Beverage</td>
					@if( $dish->is_beverage )
					<td>Yes</td>
					@else
					<td>No</td>
					@endif
				</tr>
				<tr>
					<td>Alcoholic</td>
					@if( $dish->is_alcoholic )
					<td>Yes</td>
					@else
					<td>No</td>
					@endif
				</tr>
			</table>
		</div>
		
		<!-- Right column -->
		<div class="col-6">
			<div class="grey-nav-link">
				<a href="{{ url('admin/dishes') }}">Back to dishes</a>
			</div>

			<form class="delete-form" method="post" action="{{ url('admin/dishes/'. $dish->id.'/destroy') }}">
				@csrf
				@method('delete')
				<input type="submit" value="Delete this dish" onclick="return ConfirmDelete();">
			</form>
		</div>
	</div>
</div>
@endsection

