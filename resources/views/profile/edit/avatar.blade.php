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
				<h1>Editing Avatar</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form enctype="multipart/form-data" class="content-form" method="post" action="{{ route('profile.updateavatar', $user->profile) }}">
				@csrf
				@method('PATCH')
				
				<div class="grey-nav-link">
					<a href="{{ url('profile') }}" class="back-to-list-btn">Back to Profile</a>
				</div>
				
				<div id="card-bottom">

					<div class="row">
						<div class="col-12">
							<div>
								<input type="file" name="avatar" value="Edit Avatar">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<div class="form-submit">
								<input type="submit" value="Edit Avatar">
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