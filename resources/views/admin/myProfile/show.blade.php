@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')

<div class="container">
	
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Account Settings</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<!-- Left column -->
		<div class="col-6">
			<table class="details-table">
				<tr>
					<td>Name</td>
					<td>{{ $admin->name }}</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>{{ $admin->email }}</td>
				</tr>
				<tr>
					<td>Description</td>
					<td>{{ $admin->profile->description }}</td>
				</tr>
			</table>
		</div>
		<!-- Right column -->
		<div class="col-6">
			<div class="links">
				<div class="yellow-action-link">
					<a href="{{ url('admin/my-profile/edit') }}">Change basic settings</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
