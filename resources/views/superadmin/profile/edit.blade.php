@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<form class="content-form" method="post" action="{{ url('/admin/profile/'.$profile->id.'/superadmin') }}">
		@csrf
		@method('PATCH')
		
		<div class="header-large-blue">
			<h1>Editing profile</h1>
		</div>
		
		<div class="grey-nav-link">
			<a href="{{ url('admin/profile') }}">Back</a>
		</div>
		
			
		<div class="row">
			<div class="col-md-3">
				<label for="name">Name:</label>
			</div>
			
			<div class="col-md-9">
				<input type="text" name="name" value="{{ $superAdmin->name }}">
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-3">
				<label for="email">Email:</label>
			</div>
			
			<div class="col-md-9">
				<input type="text" name="email" value="{{ $superAdmin->email }}">
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-3">
				<label for="description">Description:</label>
			</div>
			
			<div class="col-md-9">
				<input type="text" name="description" value="{{ $profile->description }}">
			</div>
		</div>
		
		<div class="row">
			<div class="col-12">
				<div class="form-submit">
					<input type="submit" value="Edit Profile">
				</div>
			</div>
		</div>
	</form>

	@if(session()->has('errors'))
	<div class="alert alert-danger mt-3 mb-0">
		@foreach( $errors->all() as $message )
		<p>Error: {{ $message }}</p>
		@endforeach
	</div>
	@endif
</div>
@endsection