<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Game Releases') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
	
	<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-sm-2" id="sidebar" style="background-color:#606060; height:100vh;">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link" href="{{ url('admin') }}">Dashboard</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="{{ url('admin/users') }}">Users</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="{{ url('admin/restaurants') }}">Restaurants</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="{{ url('') }}">Visit Website</a>
					</li>
				</ul>
			</div>
			
			<!-- Main content -->
			<div class="col-sm-10">
				@yield('content')
			</div>
		</div>
	</div>
</body>