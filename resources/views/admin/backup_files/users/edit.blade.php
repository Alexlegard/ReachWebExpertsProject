@extends('adminlte::page')

@section('content')

<div class="back-to-list-container">
	<a href="{{ url('/admin/users/'. $user->id) }}" class="back-to-list-btn">Back to User</a>
</div>

<form class="content-form" method="post" action="{{ url('/admin/users/'. $user->id) }}">
	@csrf
	@method('PATCH')
	
	<div id="card-top">
		<h1>Editing {{ $user->name }}</h1>
	</div>
	
	<div id="card-bottom">
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="name">Name:</label>
			</div>
			
			<div class="col-6">
				<input type="text" name="name" value="{{ $user->name }}">
			</div>
		</div>
		
		@if(Gate::allows('is-super-admin'))
		<div id="form-group-row">
			<div class="col-6">
				<label for="role">Role:</label>
			</div>
			
			<div class="col-6">
				<select name="role">
					@if($user->type == 'user')
					<option value="user" selected>User</option>
					<option value="admin">Admin</option>
					<option value="super">Super admin</option>
					@elseif($user->type == 'admin')
					<option value="user">User</option>
					<option value="admin" selected>Admin</option>
					<option value="super">Super admin</option>
					@elseif($user->type == 'super')
					<option value="user">User</option>
					<option value="admin">Admin</option>
					<option value="super" selected>Super admin</option>
					@endif
				</select>
			</div>
		</div>
		@endif
		
		<div id="form-group-row">
			<input type="submit" value="Edit User">
		</div>
	</div>
</form>

@foreach( $errors->all() as $message )
	<p style="color:red;">Error: {{ $message }}</p>
@endforeach

@endsection