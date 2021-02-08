@extends('adminlte::page')

@section('content')
<h1>List of admins:</h1>

<ul>
	@foreach($admins as $admin)
	<li>
		<a href="{{ url('admin/admins/' . $admin->id) }}">
			{{ $admin->name }}
		</a>
	</li>
	@endforeach
</ul>
@endsection