@extends('layouts.profile-layout')

@section('css')
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
	<div class="white-content-box">
		<div class="row">
			<div class="col-12">
				<div class="user-profile-account-settings">
					<div class="subheader-large-green">
						<h2>Account Settings</h2>
					</div>
					<table class="details-table">
						<tr>
							<td>Name</td>
							<td>{{ $user->name }}</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>{{ $user->email }}</td>
						</tr>
						<tr>
							<td>Description</td>
							<td>{{ $user->profile->description }}</td>
						</tr>
					</table>
					<div class="grey-nav-link">
						<a href="{{ url('profile/edit/settings') }}">Change basic settings</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-12">
				<div class="user-profile-account-address">
					<div class="subheader-large-green">
						<h2>Address</h2>
					</div>
					<table class="details-table">
						<tr>
							<td>Billing address</td>
							@if( isset($billing_address) )
							<td>{{ $billing_address }}</td>
							@else
							<td>Not set</td>
							@endif
						</tr>
						<tr>
							<td>Shipping address</td>
							@if( isset($shipping_address) )
							<td>{{ $shipping_address }}</td>
							@else
							<td>Not set</td>
							@endif
						</tr>
					</table>
					
					<div class="grey-nav-link">
						<a href="{{ url('profile/edit/address') }}">Change Address...</a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-12">
				<div class="user-profile-account-password">
					<div class="subheader-large-green">
						<h2>Password</h2>
					</div>
					<div class="grey-nav-link">
						<a href="{{ url('password/reset') }}">Change Password</a>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="user-profile-account-avatar">
					<div class="subheader-large-green">
						<h2>Avatar</h2>
					</div>
					<div class="user-avatar">
						<img src="{{ asset('storage/useravatars/'.$user->avatar) }}" style="width:150px;height:150px;">
					</div>
					<div class="grey-nav-link">
						<a href="{{ url('profile/edit/avatar') }}">Change Avatar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection





