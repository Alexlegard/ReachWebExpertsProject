@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Logout?</h1>
@stop

@section('content')

	@if( Auth::guard('admin')->check() )
	<form id="logout-form" action="{{ url('admin/logout') }}" method="POST">
		@csrf
		<input type="submit" value="Logout" />
	</form>
	@endif

	@if( Auth::guard('superadmin')->check() )
	<form id="logout-form" action="{{ url('superadmin/logout') }}" method="POST">
		@csrf
		<input type="submit" value="Logout" />
	</form>
	@endif
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop