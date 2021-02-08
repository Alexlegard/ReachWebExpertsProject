@extends('layouts.store-layout')

@section('js')
<script src="https://js.stripe.com/v3/"></script>
<script>
function submitChangeQty(index) {
	var form = document.getElementsByClassName("quantity-form")[index];
	
	form.submit();
}
</script>
@endsection

@section('content')

@component('components.breadcrumbs')
	<a href="/">Home</a>
	<i class="fas fa-arrow-right"></i>
	<span>Cart</span>
@endcomponent

<div id="app">
<div class="container">
	<div class="content-padding">
	</div>

	<div class="white-content-box">
		@if( Cart::count() == 0 )
		<div class="row">
			<div class="col-md-12">
				<div class="cart">
					<div class="header-large-black">
						<h1>No items in cart</h1>
					</div>
					<div class="yellow-action-link">
					<a class="button" href="{{ url('/') }}">Continue Shopping</a>
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="row">
			<div class="col-12">
				
				
				@if( Cart::count() == 1 )
				<div class="header-large-black">
					<h1>1 item in cart</h1>
				</div>
				@else
				<div class="header-large-black">
					<h1>{{ Cart::count() }} items in cart</h1>
				</div>
				@endif
			
				<table class="details-table">
					<tr>
						<th>Name</th>
						<th>Quantity</th>
						<th>Price (CAD):</th>
						<th>Delete</th>
					</tr>
					<?php $i = 0; ?>
					@foreach( Cart::content() as $item )
					<tr>
						<td>
							<a href="{{ url('dishes/'.$item->model->id) }}">
								{{ $item->model->name }}
							</a>
						</td>
						<td>
							<form class="quantity-form" action="{{ route('cart.updatequantity') }}" method="post">
								@csrf
								@method('PATCH')
								<input type="hidden" name="rowid" value="{{ $item->rowId }}">
								<select name="cartquantity" class="cart-quantity"
									onchange="submitChangeQty(<?php echo $i; ?>)">
									<option value="1"@if($item->qty == 1) selected @endif>1</option>
									<option value="2"@if($item->qty == 2) selected @endif>2</option>
									<option value="3"@if($item->qty == 3) selected @endif>3</option>
									<option value="4"@if($item->qty == 4) selected @endif>4</option>
									<option value="5"@if($item->qty == 5) selected @endif>5</option>
									<option value="6"@if($item->qty == 6) selected @endif>6</option>
									<option value="7"@if($item->qty == 7) selected @endif>7</option>
									<option value="8"@if($item->qty == 8) selected @endif>8</option>
									<option value="9"@if($item->qty == 9) selected @endif>9</option>
									<option value="10"@if($item->qty == 10) selected @endif>10</option>
								</select>
								<input type="submit" style="display:none" />
							</form>
						</td>
						@if( $item->model->on_sale )
						<td>{{ presentPrice($item->model->special_price['amount']) }}</td>
						@else
						<td>{{ presentPrice($item->model->price['amount']) }}</td>
						@endif
						<td>
							<form action="{{ route('cart.destroy', $item->rowId) }}" method="post">
								@csrf
								{{ method_field('DELETE') }}
								
								<button type="submit" class="cart-options">
									Delete
								</button>
							</form>
						</td>
					</tr>
					<?php $i++; ?>
					@endforeach
				</table>
			
				<table class="cart-price-table">
					<tr class="cart__subtotal">
						<td>Total (before tax):</td>
						<td>${{ Cart::subtotal() }}</td>
					</tr>
					<tr class="cart__tax">
						<td>Tax (13%):</td>
						<td>${{ Cart::tax() }}</td>
					</tr>
					<tr class="cart__total">
						<td>Total (after tax):</td>
						<td>${{ Cart::total() }}</td>
					</tr>
				</table>
			
				<div class="yellow-action-link">
					<a href="{{ url('checkout') }}">Checkout</a>
				</div>
			
				<div class="grey-nav-link">
					<a href="{{ url('/') }}">Continue Shopping</a>
				</div>
			
			
				@if( isset($success_message ) )
				<div class="success-message">
					<div class="alert alert-success">
					{{ $success_message }}
					</div>
				</div>
				@endif
				
			</div>
		</div>
		@endif
	</div>
</div>
</div>
@endsection