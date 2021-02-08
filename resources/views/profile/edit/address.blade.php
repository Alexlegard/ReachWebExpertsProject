@extends('layouts.profile-layout')

@section('css')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">

<style>
.account {
	background-color:#cc0000;
}
</style>
@endsection

@section('content')
<div class="container">
	<div class="content-padding">
	</div>

	<div class="row">
		<div class="col-12">
			<div class="header-large-green">
				<h1>Editing Address</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="{{ url('/profile/'. $user->profile->id.'/editaddress') }}">
				@csrf
				@method('PATCH')
				
				<div id="card-bottom">
				
					<div class="grey-nav-link">
						<a href="{{ url('profile') }}" class="back-to-list-btn">Back to Profile</a>
					</div>
					
					<!-- Billing -->
					<h5>Billing address:</h5>
					
					<div class="row">
						<div class="col-3">
							<label for="billingstreetaddress">Street address:</label>
						</div>
						<div class="col-9">
							<input type="text" name="billingstreetaddress" />
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="billingstreetaddresstwo">Street address line 2:</label>
						</div>
						<div class="col-9">
							<input type="text" name="billingstreetaddresstwo" />
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="billingcity">City:</label>
						</div>
						<div class="col-9">
							<input type="text" name="billingcity" />
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="billingstateprovince">State / Province:</label>
						</div>
						<div class="col-9">
							<input type="text" name="billingstateprovince" />
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="billingcountry">Country:</label>
						</div>
						<div class="col-9">
							<select name="billingcountry">
								<option value="Canada">Canada</option>
								<option value="United States">United States</option>
							</select>
						</div>
					</div>
					
					<!-- Shipping -->
					<h5>Shipping Address</h5>
					
					<div class="row">
						<div class="col-3">
							<label for="shippingstreetaddress">Street address:</label>
						</div>
						<div class="col-9">
							<input type="text" name="shippingstreetaddress" />
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="shippingstreetaddresstwo">Street address line 2:</label>
						</div>
						<div class="col-9">
							<input type="text" name="shippingstreetaddresstwo" />
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="shippingcity">City:</label>
						</div>
						<div class="col-9">
							<input type="text" name="shippingcity" />
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="shippingstateprovince">State / Province:</label>
						</div>
						<div class="col-9">
							<input type="text" name="shippingstateprovince" />
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="shippingcountry">Country:</label>
						</div>
						<div class="col-9">
							<select name="shippingcountry">
								<option value="Canada">Canada</option>
								<option value="United States">United States</option>
							</select>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<div class="form-submit">
								<input type="submit" value="Save">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@foreach( $errors->all() as $message )
	<p style="color:red;">Error: {{ $message }}</p>
@endforeach
	
@endsection