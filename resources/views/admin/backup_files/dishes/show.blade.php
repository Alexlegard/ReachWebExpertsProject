@extends('adminlte::page')

@section('js')
<script>
	function ConfirmDelete(){
		if(!confirm("Are you sure you want to delete this dish?"))
		event.preventDefault();
	}
</script>
@endsection

@section('content')
<div>
	<a href="{{ url('admin/dishes') }}">Back to List</a>
</div>
<div>
	<a href="{{ url('admin/dishes/' . $dish->id . '/edit') }}">Edit this dish</a>
</div>

<form class="delete-form" method="post" action="{{ url('admin/dishes/'. $dish->id) }}">
	@csrf
	@method('DELETE')
	<input type="submit" value="Delete this dish" onclick="return ConfirmDelete();">
</form>

<h1>{{ $dish->name }}</h1>

@if( $dish->image )
<!-- img src="asset('storage/' . $dish->image) alt="?" class="dish-image" -->

@endif

<p>Price: ${{ $dish->price['amount'] }} {{ $dish->price['currency'] }}</p>

<p>Cuisine: {{ $dish->cuisine }}</p>

<p>People served: {{ $dish->people_served }}</p>

@endsection






