@extends('adminlte::page')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				@if( count($restaurants) == 0 )
				<h1>No restaurants found</h1>
				@else
				<h1>Showing restaurants</h1>
				@endif
			</div>
		</div>
	</div>
	@if( count($restaurants) >= 1 )
	<div class="row">
		<div class="col-12">
			<ul>
				@foreach($restaurants as $restaurant)
				<li>
					<a href="{{ url('admin/restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	@endif
	
	{{ $restaurants->links() }}
</div>

@endsection