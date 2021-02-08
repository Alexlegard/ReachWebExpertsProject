@extends('adminlte::page')

@section('js')
<script>
	function ConfirmDelete(){
		if(!confirm("Are you sure you want to delete this restaurant?"))
		event.preventDefault();
	}
</script>
@endsection

<?php
// Set address string
if(isset($restaurant->address['streetaddresstwo'])) {
	$address = $restaurant->address['streetaddress'] . ', ' .
	$restaurant->address['streetaddresstwo'] . ', ' .
	$restaurant->address['city'] . ', ' .
	$restaurant->address['stateprovince'] . ', ' .
	$restaurant->address['country'];
} else {
	$address = $restaurant->address['streetaddress'] . ', ' .
	$restaurant->address['city'] . ', ' .
	$restaurant->address['stateprovince'] . ', ' .
	$restaurant->address['country'];
}
?>

@section('content')
<div>
	<a href="{{ url('admin/restaurants') }}">Back to List</a>
</div>
<div>
	<a href="{{ url('admin/restaurants/' . $restaurant->id . '/edit') }}">Edit this restaurant</a>
</div>
<div>
	<a href="{{ url('admin/restaurants/' . $restaurant->id . '/createdish') }}">Add new dish</a>
</div>
@if( count($restaurant->menu->dish) > 0 )
<div>
	<a href="{{ url('admin/restaurants/' . $restaurant->id . '/dishes') }}">
		Dishes from {{ $restaurant->name }}
	</a>
</div>
@endif
@if( count($restaurant->review) > 0 )
<div>
	<a href="{{ url('admin/restaurants/' . $restaurant->id . '/reviews') }}">
		Reviews on {{ $restaurant->name }}
	</a>
</div>
@endif
<form class="delete-form" method="post" action="{{ url('admin/restaurants/'. $restaurant->id) }}">
	@csrf
	@method('DELETE')
	<input type="submit" value="Delete this restaurant" onclick="return ConfirmDelete();">
</form>

<h1>{{ $restaurant->name }}</h1>

@if( $restaurant->image )
<!-- img src="asset('storage/' . $restaurant->image) alt="?" class="restaurant-image" -->
@endif

<p>Address: {{ $address }}</p>

<p>Cuisine:</p>
<ul>
@foreach($restaurant->cuisine as $cuisine)
	@if( isset($cuisine) )
		<li>{{ $cuisine }}</li>
	@endif
@endforeach
</ul>

@endsection






