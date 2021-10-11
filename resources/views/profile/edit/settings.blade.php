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
				<h1>Editing Settings</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="{{ url('/profile/'. $user->profile->id.'/editsettings') }}">
				@csrf
				@method('PATCH')
				
				<div class="grey-nav-link">
					<a href="{{ url('profile') }}" class="back-to-list-btn">Back to Profile</a>
				</div>
				
				<div id="card-bottom">
					
					<div class="row">
						<div class="col-3">
							<label for="name">Name:</label>
						</div>
						<div class="col-9">
							<input type="text" name="name" value="{{ Auth::user()->name }}"/>
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="email">Email address:</label>
						</div>
						<div class="col-9">
							<input type="text" name="email" value="{{ Auth::user()->email }}"/>
						</div>
					</div>
					
					<div class="row">
						<div class="col-3">
							<label for="description">Description:</label>
						</div>
						<div class="col-9">
							<input type="text" name="description" value="{{ Auth::user()->profile->description }}"/>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<div class="form-submit">
								<input type="submit" value="Edit Profile">
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