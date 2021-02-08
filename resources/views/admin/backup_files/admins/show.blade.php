@extends('adminlte::page')

@section('js')
<script>
	function ConfirmDelete(){
		if(!confirm("Are you sure to delete this admin?"))
		event.preventDefault();
	}
</script>
@endsection

@section('content')

<div>
	<a href="{{ url('admin/admins') }}">Back to list</a>
</div>
<div>
	<a href="{{ url('admin/admins/' . $admin->id . '/edit') }}">Edit this admin</a>
</div>

<form class="delete-form" method="post" action="{{ url('admin/admins/'. $admin->id) }}">
	@csrf
	@method('DELETE')
	<input type="submit" value="Delete this admin" onclick="return ConfirmDelete();">
</form>

<h1>{{ $admin->name }}</h1>

<p>Email: {{ $admin->email }}</p>

<p>Role: {{ $admin->type }}</p>

@endsection