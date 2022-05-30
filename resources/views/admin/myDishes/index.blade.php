@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="breadcrumbs">
				<span>Dishes</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				@if(! isset($dishes[0]) )
				<h1>No dishes found for your restaurants.</h1>
				@else
				<h1>My Dishes</h1>
				@endif
			</div>
		</div>
	</div>
	
	@if( isset($dishes[0]) )
	<div class="row">
		<div class="col-12">
			<table class="admin-dishes-table">
				<tr>
					<th>Restaurant</th>
					<th>Address</th>
					<th>Dishes</th>
				</tr>
				@foreach( $restaurants as $restaurant )
				@if( $restaurant->menu->dish->count() )
				<tr>
					<td>
						<div>
							<a href="{{ url('admin/my-restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
						</div>
					</td>
					<td>
						<div>
							{{ getAddress($restaurant); }}
						</div>
					</td>
					<td>
						@foreach($restaurant->menu->dish as $dish)
						<div>
							<a href="{{ url('admin/my-dishes/'.$dish->id) }}">{{ $dish->name }}</a>
						</div>
						@endforeach
					</td>
				</tr>
				@endif
				@endforeach
			</table>
		</div>
	</div>
	@endif
	
	{{ $restaurants->links() }}
</div>

@endsection