@extends('adminlte::page')

@section('js')
<script>
function ConfirmBan(){
	if(!confirm("Are you sure you want to ban this admin?"))
	event.preventDefault();
}
function ConfirmUnban(){
	if(!confirm("Are you sure you want to unban this admin?"))
	event.preventDefault();
}
function ConfirmDelete(){
	if(!confirm("Are you sure you want to delete this admin?"))
	event.preventDefault();
}
</script>
@endsection

@section('css')
<style>
h4 {
	margin-top:1em;
}
</style>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Showing {{ $admin->name }}</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
	
		<!-- Left column -->
		<div class="col-6">
			<div class="admin-details">
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
						<td>Banned</td>
						@if( $admin->is_banned )
						<td>Yes</td>
						@else
						<td>No</td>
						@endif
					</tr>
				</table>
			</div>
		</div>
		
		<!-- Right column -->
		<div class="col-6">
			<div class="links">
				<div class="grey-nav-link">
					<a href="{{ url('admin/admins') }}">Back to admins</a>
				</div>
				@if(! $admin->is_banned )
				<form class="ban-form" method="post" action="{{ url('admin/admins/'. $admin->id.'/ban') }}">
					@csrf
					@method('patch')
					<input type="submit" value="Ban this admin" onclick="return ConfirmBan();">
				</form>
				@else
				<form class="unban-form" method="post" action="{{ url('admin/admins/'. $admin->id.'/unban') }}">
					@csrf
					@method('patch')
					<input type="submit" value="Unban this admin" onclick="return ConfirmUnban();">
				</form>
				@endif
				<form class="delete-form" method="post" action="{{ url('admin/admins/'. $admin->id.'/delete') }}">
					@csrf
					@method('delete')
					<input type="submit" value="Delete this admin" onclick="return ConfirmDelete();">
				</form>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="restaurants">
				
				@if( count($restaurants) == 0 )
				<h4>No restaurants for {{ $admin->name }}</h4>
				@else
				<h4>Showing restaurants for {{ $admin->name }}</h4>
				@endif
				
				@if( count($restaurants) >= 1 )
				<ul>
					@foreach($restaurants as $restaurant)
					<li>
						<a href="{{ url('admin/restaurants/'.$restaurant->id) }}">{{ $restaurant->name }}</a>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection