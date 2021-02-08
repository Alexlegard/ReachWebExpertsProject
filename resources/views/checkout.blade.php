@extends('layouts.store-layout')

@section('js')
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/checkout/modals.js') }}"></script>
@endsection

@section('js-bottom')
<script>
window.addEventListener('load', function () {
	// Create a Stripe client.
	var stripe = Stripe('pk_test_51GzYZgEwovnXVY3jkkOEU9D2LPBzKykl4RZaSARJp7cbkjSvbIYMZOU8eg1025kPkz1Z4Nm9QyfVkPBMGMrxLPR300hZWGEQsS');

	// Create an instance of Elements.
	var elements = stripe.elements();

	// Custom styling can be passed to options when creating an Element.
	// (Note that this demo uses a wider set of styles than the guide below.)
	var style = {
	  base: {
		color: '#32325d',
		fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
		fontSmoothing: 'antialiased',
		fontSize: '16px',
		'::placeholder': {
		  color: '#aab7c4'
		}
	  },
	  invalid: {
		color: '#fa755a',
		iconColor: '#fa755a'
	  }
	};

	// Create an instance of the card Element.
	var card = elements.create('card', {
		style: style,
		hidePostalCode: true
	});

	// Add an instance of the card Element into the `card-element` <div>.
	card.mount('#card-element');

	// Handle real-time validation errors from the card Element.
	card.on('change', function(event) {
	  var displayError = document.getElementById('card-errors');
	  if (event.error) {
		displayError.textContent = event.error.message;
	  } else {
		displayError.textContent = '';
	  }
	});

	// Handle form submission.
	var form = document.getElementById('payment-form');
	form.addEventListener('submit', function(event) {
	  //alert("Form submitted.");
	  event.preventDefault();
	  
	  // Disable the submit button to prevent repeated clicks
      document.getElementById('complete-order').disabled = true;
	  
	  // Billing address
	  var options = {
		  name: document.getElementById('card-name').value,
		  //address_line1: document.getElementById('address').value,
		  //address_city:document.getElementById('city').value,
		  //address_state:document.getElementById('province').value,
		  address_zip:document.getElementById('postal-code').value
	  }

	  stripe.createToken(card, options).then(function(result) {
		if (result.error) {
		  // Inform the user if there was an error.
		  var errorElement = document.getElementById('card-errors');
		  errorElement.textContent = result.error.message;
		  
		  // Enable the submit button
          document.getElementById('complete-order').disabled = false;
		} else {
		  // Payment has been processed!
		  // Send the token to your server.
		  stripeTokenHandler(result.token);
		}
	  });
	});

	// Submit the form with the token ID.
	function stripeTokenHandler(token) {
	  // Insert the token ID into the form so it gets submitted to the server
	  var form = document.getElementById('payment-form');
	  var hiddenInput = document.createElement('input');
	  hiddenInput.setAttribute('type', 'hidden');
	  hiddenInput.setAttribute('name', 'stripeToken');
	  hiddenInput.setAttribute('value', token.id);
	  
	  // ('payment-form').appendChild('input')
	  form.appendChild(hiddenInput);

	  // Submit the form
	  form.submit();
	}
});
</script>
@endsection

@section('css')
<link href="{{ asset('css/StripeElement.css') }}" rel="stylesheet">
<style>
.content {
	padding-top:1em;
}
.coupon {
	background-color:white;
	border:1px solid black;
	padding:1em;
	margin-top:1em;
}
.order-total {
	background-color:white;
	border:1px solid black;
	padding:1em;
	margin-top:1em;
}
.order-total table {
	width:100%;
}
.form-submit {
	margin-top:1em;
}
</style>
@endsection

@section('content')
<div id="app">
	<div class="container">

		@if (session()->has('success_message'))
            <div class="spacer"></div>
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(session()->has('errors'))
            <div class="spacer"></div>
            <div class="alert alert-danger mt-3">
                <ul>
					<!-- Address form errors -->
					@if($errors->has('streetaddress'))
						<li>{{ $errors->first('streetaddress') }}</li>
					@endif
					@if($errors->has('city'))
						<li>{{ $errors->first('city') }}</li>
					@endif
					@if($errors->has('stateprovince'))
						<li>The state / province field is required.</li>
					@endif
					
					<!-- Checkout form errors -->
					@if( $errors->has('card_name') )
					<li>{{ $errors->first('card_name') }}</li>
					@endif
					@if( $errors->has('postal_code') )
					<li>{{ $errors->first('postal_code') }}</li>
					@endif
					
					<!-- Coupon errors -->
					@if( $errors->has('couponcode') )
					<li>Please enter a coupon code.</li>
					@endif
					@if( $errors->has('invalidcoupon') )
					<li>Coupon code is invalid. Please try again.</li>
					@endif
                </ul>
            </div>
        @endif
		
		<div class="content">
			<div class="row">
				<div class="col-md-8">
					
						<div class="header-large-black">
							<h1>Checkout</h1>
						</div>
						
						<div class="white-content-box">
							<div class="shipping-address">
								<h2>1. Shipping Address</h2>
								
								@if( isset($shipping_address) )
								<div>{{ $shipping_address }}</div>
								@else
								<div>Shipping address not set.</div>
								@endif
								
								<button id="shipping-address-button" class="shipping-address-button" style="margin-bottom:1em">Change</button>
							
								<div id="shipping-address-modal" class="shipping-address-modal">
									<div class="modal-content">
										<span class="close">&times;</span>
										
										<form class="content-form" method="post" action="{{ url('/profile/'. $user->profile->id.'/editshippingaddress') }}">
											@csrf
											@method('PATCH')
											<div id="card-bottom">
												
												<h5>Shipping Address</h5>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="streetaddress">Street address:</label>
													</div>
													<div class="col-6">
														<input type="text" name="streetaddress" />
													</div>
												</div>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="streetaddresstwo">Street address line 2:</label>
													</div>
													<div class="col-6">
														<input type="text" name="streetaddresstwo" />
													</div>
												</div>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="city">City:</label>
													</div>
													<div class="col-6">
														<input type="text" name="city" />
													</div>
												</div>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="stateprovince">State / Province:</label>
													</div>
													<div class="col-6">
														<input type="text" name="stateprovince" />
													</div>
												</div>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="country">Country:</label>
													</div>
													<div class="col-6">
														<select name="country">
															<option value="Canada">Canada</option>
															<option value="United States">United States</option>
														</select>
													</div>
												</div>
												
												<div id="form-group-row">
													<input class="submit-btn" type="submit" value="Save">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						
						<div class="white-content-box">
							<div class="billing_address">
							
								<div style="display:none;" id="address">{{ $profile->billing_address['streetaddress'] ?? '' }}</div>
								<div style="display:none;" id="city">{{ $profile->billing_address['city'] ?? '' }}</div>
								<div style="display:none;" id="province">{{ $profile->billing_address['stateprovince'] ?? '' }}</div>
							
								<h2>2. Billing Address</h2>
								
								@if( isset($billing_address) )
								<div>{{ $billing_address }}</div>
								@else
								<div>Billing address not set.</div>
								@endif
								
								<button id="billing-address-button" class="billing-address-button" style="margin-bottom:1em">Change</button>
							
								<div id="billing-address-modal" class="billing-address-modal">
									<div class="modal-content">
										<span class="close">&times;</span>
									
										<form class="content-form" method="post" action="{{ url('/profile/'. $user->profile->id.'/editbillingaddress') }}">
											@csrf
											@method('PATCH')
											<div id="card-bottom">
												
												<h5>Billing address</h5>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="streetaddress">Street address:</label>
													</div>
													<div class="col-6">
														<input type="text" name="streetaddress" />
													</div>
												</div>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="streetaddresstwo">Street address line 2:</label>
													</div>
													<div class="col-6">
														<input type="text" name="streetaddresstwo" />
													</div>
												</div>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="city">City:</label>
													</div>
													<div class="col-6">
														<input type="text" name="city" />
													</div>
												</div>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="stateprovince">State / Province:</label>
													</div>
													<div class="col-6">
														<input type="text" name="stateprovince" />
													</div>
												</div>
												
												<div id="form-group-row">
													<div class="col-6">
														<label for="country">Country:</label>
													</div>
													<div class="col-6">
														<select name="country">
															<option value="Canada">Canada</option>
															<option value="United States">United States</option>
														</select>
													</div>
												</div>
												
												<div id="form-group-row">
													<input class="submit-btn" type="submit" value="Save">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						
						<div class="white-content-box">
							<div class="payment-details">
								<h2>3. Payment Details</h2>
								
								<form action="{{ route('checkout.store') }}" method="post"
									class="payment-form" id="payment-form">
									@csrf
									
									<input type="hidden" name="streetaddress" value="{{ $profile->billing_address['streetaddress'] ?? '' }}">
									<input type="hidden" name="streetaddresstwo" value="{{ $profile->billing_address['streetaddresstwo'] ?? '' }}">
									<input type="hidden" name="city" value="{{ $profile->billing_address['city'] ?? '' }}">
									<input type="hidden" name="stateprovince" value="{{ $profile->billing_address['stateprovince'] ?? '' }}">
									<input type="hidden" name="country" value="{{ $profile->billing_address['country'] ?? '' }}">
									<!-- Set the coupon discount to always be 0 I hate you
									heroku. -->
									<input type="hidden" name="discount" value="0">
									
										
									<div id="row">
										<div>
											<input type="text" name="card_name" id="card-name" placeholder="Enter name" style="margin-top:1em;margin-bottom:1em" />
										</div>
									</div>
									
									<div id="row">
										<div>
											<input type="text" name="postal_code" id="postal-code" placeholder="Enter postal code" style="margin-bottom:1em" />
										</div>
									</div>
									
									<div id="row">
										<div id="card-element">
											<!-- Stripe element will be inserted here. -->
										</div>
										
										<!-- Errors -->
										<div id="card-errors" role="alert"></div>
									
										<button type="submit" id="complete-order" class="checkout-button"
											data-secret="{{ $client_secret }}" >
											Place Order
										</button>
									</div>
								</form>
							
							</div>
						</div>
				</div>
				
				<!-- Right column -->
				<div class="col-md-4">
					<div class="order-details">
						<h2>Order Details</h2>
						
						<table class="cart-items-table">
							<tr>
								<th>Name</th>
								<th>Quantity</th>
								<th>Price (CAD):</th>
							</tr>
							@foreach( Cart::content() as $item )
							<tr>
								<td>
									<a href="{{ url('dishes/'.$item->model->id) }}">
										{{ $item->model->name }}
									</a>
								</td>
								<td>{{ $item->qty }}</td>
								@if($item->model->on_sale)
								<td>{{ presentPrice($item->model->special_price['amount']) }}</td>
								@else
								<td>{{ presentPrice($item->model->price['amount']) }}</td>
								@endif
							</tr>
							@endforeach
							
						</table>
					</div>
					
					<div class="order-total">
						<table class="order-total-table">
							<tr>
								<td>Subtotal</td>
								<td>{{ presentPrice(Cart::subtotal()) }}</td>
							</tr>
							@if(session()->has('coupon'))
							<tr>
								<td>Discount</td>
								<td>
									{{ presentPrice(session()->get('coupon')['discount']) }}
								</td>
							</tr>
							<tr>
								<td>New subtotal</td>
								<td>{{ presentPrice($newSubtotal) }}</td>
							</tr>
							@endif
							<tr>
								<td>Tax</td>
								<td>{{ presentPrice($newTax) }}</td>
							</tr>
							<tr>
								<td>Total</td>
								<td>{{ presentPrice($newTotal) }}</td>
							</tr>
						</table>
						@if(session()->has('coupon'))
						<form action="{{ route('coupon.destroy') }}" method="post">
							@csrf
							@method('delete')
							<div class="form-submit">
								<input type="submit" value="Remove">
							</div>
						</form>
						@endif
					</div>
					
					<div class="coupon">
						<h2>Have a code?</h2>
						
						<form action="{{ route('coupon.store') }}" method="post"
								class="coupon-form" id="coupon-form">
							@csrf
							<div id="row">
								<div>
									<input type="text" name="couponcode" id="couponcode" />
								</div>
								<div class="form-submit">
									<input type="submit" value="Apply">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</div>
</div>
@endsection
















