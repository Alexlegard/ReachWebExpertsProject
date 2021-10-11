<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RWE Store') }}</title>
	
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">


	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	
	<!-- Google fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">	
	
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
	@yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
	@yield('css')
</head>
<body>
    <div id="app">
        
		@include('includes.store-top-nav')

        <main>
            @yield('content')
        </main>
    </div>
	@yield('js-bottom')
</body>
</html>
