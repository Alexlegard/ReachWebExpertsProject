<nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
	<div class="container">
		<a class="navbar-brand text-light" href="{{ url('/') }}">
			{{ config('app.name', 'RWE Store') }}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">

			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
			

				<li class="nav-item">
					<!-- If USER is logged in -->
					@if( Auth()->check() )
					<div class="top-nav-links">
						<a href="{{ url('profile') }}">Profile</a>
						<a href="{{ url('cart') }}">
							Cart
							<i class="fas fa-shopping-cart"></i>
						</a>
						<a href="#"
							onclick="event.preventDefault();
							document.querySelector('#logout-form').submit();">
							Logout
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
					<!-- If ADMIN is logged in -->
					@elseif(Auth::guard('admin')->check())
					<div class="top-nav-links">
						<a href="{{ url('admin/dashboard') }}">Admin Dashboard</a>
						<a href="#"
							onclick="event.preventDefault();
							document.querySelector('#admin-logout-form').submit();">
							Logout
						</a>
						<form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
					@elseif(Auth::guard('superadmin')->check())
					<div class="top-nav-links">
						<a href="{{ url('admin/dashboard') }}">Admin Dashboard</a>
						<a href="#"
							onclick="event.preventDefault();
							document.querySelector('#superadmin-logout-form').submit();">
							Logout
						</a>
						<form id="superadmin-logout-form" action="{{ url('superadmin/logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
					@else
					<!-- If no one is logged in -->
					<div class="top-nav-links">
						<a href="{{ url('login') }}">Login</a>
						<a href="{{ url('register') }}">Register</a>
						<a href="{{ url('cart') }}">
							Cart
							<i class="fas fa-shopping-cart"></i>
						</a>
					</div>
					@endif
				</li>
			</ul>
		</div>
	</div>
</nav>