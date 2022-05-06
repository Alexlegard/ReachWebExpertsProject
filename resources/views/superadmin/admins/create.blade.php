@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Create New Admin</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="/admin/admins">
				@csrf
				
				<p>You can create a new admin account. An email will automatically be sent containing a secure password.</p>
				
				<div class="grey-nav-link">
					<a href="{{ url('admin/admins') }}">Back to admins</a>
				</div>

				<!-- We should enter their name, email address, and password. -->
				
				<div class="row">
					<div class="col-md-3">
						<label for="name">Name:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="name" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="email">Email:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="email" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-12">
						<div class="form-submit">
							<input type="submit" value="Create Admin" />
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	@if(session()->has('errors'))
	<div class="alert alert-danger mt-3 mb-0">
		@foreach( $errors->all() as $message )
		<p>Error: {{ $message }}</p>
		@endforeach
	</div>
	@endif
</div>

@endsection