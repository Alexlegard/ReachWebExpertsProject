@extends('adminlte::page')

@section('js')
<script>
	function ConfirmDelete(){
		if(!confirm("Are you sure to delete this user?"))
		event.preventDefault();
	}
</script>
@endsection

@section('content')

<div>
	<a href="{{ url('admin/users') }}">Back to List</a>
</div>
<div>
	<a href="{{ url('admin/users/' . $user->id . '/edit') }}">Edit this user</a>
</div>

<form class="delete-form" method="post" action="{{ url('admin/users/'. $user->id) }}">
	@csrf
	@method('DELETE')
	<input type="submit" value="Delete this user" onclick="return ConfirmDelete();">
</form>

<h1>{{ $user->name }}</h1>

<p>Email: {{ $user->email }}</p>

@if(Gate::allows('is-super-admin'))
<p>Role: {{ $user->type }}</p>
@endif

@endsection