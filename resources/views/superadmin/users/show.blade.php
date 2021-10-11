@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('js')
<script>
function ConfirmBan(){
	if(!confirm("Are you sure you want to ban this user?"))
	event.preventDefault();
}
function ConfirmUnban(){
	if(!confirm("Are you sure you want to unban this user?"))
	event.preventDefault();
}
function ConfirmDelete(){
	if(!confirm("Are you sure you want to delete this user?"))
	event.preventDefault();
}
</script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Showing {{ $user->name }}</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-6">
			<div class="user">
				<table class="details-table">
					<tr>
						<td>Name</td>
						<td>{{ $user->name }}</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>{{ $user->email }}</td>
					</tr>
					<tr>
						<td>Created at</td>
						<td>{{ $user->created_at }}</td>
					</tr>
					<tr>
						<td>Banned</td>
						@if( $user->is_banned )
						<td>Yes</td>
						@else
						<td>No</td>
						@endif
					</tr>
				</table>
			</div>
		</div>
		
		<div class="col-6">
			<div class="links">
				<div class="grey-nav-link">
					<a href="{{ url('admin/users') }}">Back to users</a>
				</div>
				@if(! $user->is_banned )
				<form class="ban-form" method="post" action="{{ url('admin/users/'. $user->id.'/ban') }}">
					@csrf
					@method('patch')
					<input type="submit" value="Ban this user" onclick="return ConfirmBan();">
				</form>
				@else
				<form class="unban-form" method="post" action="{{ url('admin/users/'. $user->id.'/unban') }}">
					@csrf
					@method('patch')
					<input type="submit" value="Unban this user" onclick="return ConfirmUnban();">
				</form>
				@endif
				<form class="delete-form" method="post" action="{{ url('admin/users/'. $user->id.'/delete') }}">
					@csrf
					@method('delete')
					<input type="submit" value="Delete this user" onclick="return ConfirmDelete();">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection