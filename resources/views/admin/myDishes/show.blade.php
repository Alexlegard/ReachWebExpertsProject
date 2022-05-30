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
				<a href="{{ url('admin/my-restaurants') }}">Restaurants</a>
				<i class="fas fa-arrow-right"></i>
				<a href="{{ url('admin/my-restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
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
			<div>{{ $dish->description }}</div>
		</div>
	</div>

	<hr>

	<div class="row">
	
		<!-- Left column -->
		<div class="col-6">

			<table class="details-table">
				<!-- Special price and calories are nullable -->
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
				<tr>
					<td>On Sale</td>
					@if( $dish->on_sale )
					<td>Yes</td>
					@else
					<td>No</td>
					@endif
				</tr>
				@if( $dish->on_sale )
				<tr>
					<td>On Sale Until</td>
					<td>{{ $dish->on_sale_until }}</td>
				</tr>
				@endif
				<tr>
					<td>Image</td>
					<td>
						<img src="{{ asset('storage/dishimages/'.$dish->image) }}" width="100" height="100">
					</td>
				</tr>
			</table>
		</div>
		
		<!-- Right column -->
		<div class="col-6">
			<div class="links">
				<div class="yellow-action-link">
					<a href="{{ url('admin/my-dishes/'.$dish->id.'/edit') }}">Edit this dish</a>
				</div>
				@if(! $dish->on_sale )
				<div class="yellow-action-link">
					<a href="{{ url('admin/my-dishes/'.$dish->id.'/sale') }}">Put on sale</a>
				</div>
				@else
				<form method="post" action="{{ url('admin/my-dishes/'.$dish->id.'/unsale') }}">
					@csrf
					@method('DELETE')
					<div class="form-submit">
						<input type="submit" value="Remove sale">
					</div>
				</form>
				@endif

				<form class="delete-form" method="post" action="{{ url('admin/my-dishes/'. $dish->id) }}">
					@csrf
					@method('DELETE')
					<input type="submit" value="Delete this dish" onclick="return ConfirmDelete();">
				</form>
			</div>
		</div>
	</div>
	
	<hr>

	<!-- Left column -->
	<div class="row">
		<div class="col-6">
			<div class="orders">
				<div class="orders-header">
				@if( count($orders) < 1)
					<h4>No orders for {{ $dish->name }}</h4>
				@elseif( count($orders) ==  1 )
					<h4>1 order for {{ $dish->name }}</h4>
				@else
					<h4>{{ count($orders) }} orders for {{ $dish->name }}</h4>
				@endif
				</div>

				@if( count($orders) >= 1 )
				<div class="orders-list">
					<ul>
					@foreach($orders as $order)
						<li>
							<a href="{{ url('admin/orders/'.$order->id) }}">
								{{ $order->time_placed }}
							</a>
						</li>
					@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
		
		<!-- Right column -->
		<div class="col-6">
			<div class="selections">
				<div class="selections-header">
					@if( count($dish->selections) == 0 )
					<h4>No selections for {{ $dish->name }}</h4>
					@elseif( count($dish->selections) == 1 )
					<h4>1 selection for {{ $dish->name }}</h4>
					@else
					<h4>{{ count($dish->selections) }} selections for {{ $dish->name }}</h4>
					@endif
				</div>
				<div class="yellow-action-link">
					<a href="{{ url('admin/my-dishes/'.$dish->id.'/selections/add') }}">Add New Selection</a>
				</div>
				@if( count($dish->selections) >= 1 )
				<div class="selections-list">
					<ul>
						@foreach($dish->selections as $selection)
						<li>
							<a href="{{ url('admin/my-selections/'.$selection->id) }}">{{ $selection->name }}</a>
						</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
	</div>

</div>
@endsection