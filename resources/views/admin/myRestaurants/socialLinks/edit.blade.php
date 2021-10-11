@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Editing {{ $restaurant->name }}</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<form class="content-form" method="post" action="{{ url('/admin/my-restaurants/'. $restaurant->id .'/social-links') }}">
				@csrf
				@method('PATCH')
				
				
				
				<div class="grey-nav-link">
					<a href="{{ url('/admin/my-restaurants/'. $restaurant->id) }}" class="back-to-list-btn">Back to Restaurant</a>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="facebook">Facebook:</label>
					</div>
					
					<div class="col-md-9">
						<input type="text" name="facebook" value="{{ $restaurant->facebook ?? '' }}">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="twitter">Twitter:</label>
					</div>
					
					<div class="col-md-9">
						<input type="text" name="twitter" value="{{ $restaurant->twitter ?? '' }}">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
						<label for="instagram">Instagram:</label>
					</div>
					
					<div class="col-md-9">
						<input type="text" name="instagram" value="{{ $restaurant->instagram ?? '' }}">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="form-submit">
							<input type="submit" value="Edit Social Links">
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