@extends('adminlte::page')

@section('content')

<div class="back-to-list-container">
	<a href="{{ url('/admin/admins/'. $admin->id) }}" class="back-to-list-btn">Back</a>
</div>

<form class="content-form" method="post" action="{{ url('/admin/admins/'. $admin->id) }}">
	@csrf
	@method('PATCH')
	
	<div id="card-top">
		<h1>Editing {{ $admin->name }}</h1>
	</div>
	
	<div id="card-bottom">
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="name">Name:</label>
			</div>
			
			<div class="col-6">
				<input type="text" name="name" value="{{ $admin->name }}">
			</div>
		</div>
		
		<div id="form-group-row">
			<div class="col-6">
				<label for="role">Role:</label>
			</div>
			
			<div class="col-6">
				<select name="role">
					@if($admin->type == 'user')
					<option value="user" selected>User</option>
					<option value="admin">Admin</option>
					<option value="super">Super admin</option>
					@elseif($admin->type == 'admin')
					<option value="user">User</option>
					<option value="admin" selected>Admin</option>
					<option value="super">Super admin</option>
					@elseif($admin->type == 'super')
					<option value="user">User</option>
					<option value="admin">Admin</option>
					<option value="super" selected>Super admin</option>
					@endif
				</select>
			</div>
		</div>
		
		<div id="form-group-row">
			<input type="submit" value="Edit Admin">
		</div>
	</div>
</form>

@endsection