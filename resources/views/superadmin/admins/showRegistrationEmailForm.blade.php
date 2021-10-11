@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Send Sign Up Email</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="{{ url('admin/admins/sendRegistrationEmail') }}">
				@csrf

				<p>Fill out the form to send an email so the recipient can register as an admin.</p>

				<div class="grey-nav-link">
					<a href="{{ url('admin/admins') }}">Back to admins</a>
				</div>

				<!-- We require only the email address field -->
				<div class="row">
					<div class="col-md-3">
						<label for="recipient-email">Recipient email address:</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="recipientemail" />
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="form-submit">
							<input type="submit" value="Send email" />
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