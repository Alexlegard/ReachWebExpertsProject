@extends('layouts.profile-layout')

@section('content')

<div class="back-to-list-container">
	<a href="{{ url('profile') }}" class="back-to-list-btn">Back to Profile</a>
</div>

<form class="content-form" method="post" action="{{ url('/profile/'. $user->profile->id) }}">
	@csrf
	@method('PATCH')
	
	<div id="card-top">
		<h1>Editing Profile</h1>
	</div>
	
	<div id="card-bottom">
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="description">Description:</label>
			</div>
			
			<div class="col-6">
				<input type="text" name="description" value="{{ $user->profile->description }}">
			</div>
		</div>
		
		<!-- Billing -->
		<h5>Billing address:</h5>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="billingstreetaddress">Street address:</label>
			</div>
			<div class="col-6">
				<input type="text" name="billingstreetaddress" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="billingstreetaddresstwo">Street address line 2:</label>
			</div>
			<div class="col-6">
				<input type="text" name="billingstreetaddresstwo" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="billingcity">City:</label>
			</div>
			<div class="col-6">
				<input type="text" name="billingcity" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="billingstateprovince">State / Province:</label>
			</div>
			<div class="col-6">
				<input type="text" name="billingstateprovince" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="billingcountry">Country:</label>
			</div>
			<div class="col-6">
				<select name="billingcountry">
					<option value="Canada">Canada</option>
					<option value="United States">United States</option>
				</select>
			</div>
		</div>
		
		<!-- Shipping -->
		<h5>Shipping Address</h5>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="shippingstreetaddress">Street address:</label>
			</div>
			<div class="col-6">
				<input type="text" name="shippingstreetaddress" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="shippingstreetaddresstwo">Street address line 2:</label>
			</div>
			<div class="col-6">
				<input type="text" name="shippingstreetaddresstwo" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="shippingcity">City:</label>
			</div>
			<div class="col-6">
				<input type="text" name="shippingcity" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="shippingstateprovince">State / Province:</label>
			</div>
			<div class="col-6">
				<input type="text" name="shippingstateprovince" />
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="shippingcountry">Country:</label>
			</div>
			<div class="col-6">
				<select name="shippingcountry">
					<option value="Canada">Canada</option>
					<option value="United States">United States</option>
				</select>
			</div>
		</div>
		
		<div id="form-group-row">
			<input type="submit" value="Edit Profile">
		</div>
	</div>
</form>

@foreach( $errors->all() as $message )
	<p style="color:red;">Error: {{ $message }}</p>
@endforeach
	
@endsection