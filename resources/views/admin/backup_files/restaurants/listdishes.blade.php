@extends('adminlte::page')

@section('content')
<h1>Dishes from {{ $dishes[0]->menu->restaurant->name }}</h1>

<ul>
@foreach( $dishes as $dish )
	<li>
		<a href="{{ url('admin/dishes/' . $dish->id) }}">
			{{ $dish->name }}
		</a>
	</li>
@endforeach
</ul>
@endsection