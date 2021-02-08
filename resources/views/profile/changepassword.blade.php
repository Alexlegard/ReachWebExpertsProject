@extends('layouts.profile-layout')

@section('css')

@endsection

@section('content')
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
		
		
		
		<div id="form-group-row">
			<input type="submit" value="Edit Profile">
		</div>
	</div>
</form>
@endsection