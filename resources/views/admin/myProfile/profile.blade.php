@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="p-3 mb-2 bg-primary text-white">
				<h2>Account Settings</h2>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<div id="account-settings">
		
			<table>
				<tr>
					<td>Name:</td>
					<td>{{ $user->name }}</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>{{ $user->email }}</td>
				</tr>
				<tr>
					<td>Description:</td>
					<td>{{ $user->profile->description }}</td>
				</tr>
			</table>
			<div>
				<a href="{{ url('profile/edit/settings') }}">Change basic settings</a>
			</div>
		</div>
	</div>
</div>
	
	
</div>
@endsection
