@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')
<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="breadcrumbs">
				<span>Admins</span>
			</div>
		</div>
	</div>

	<!-- Session message -->
	@if(Session::has('message'))
		<p class="alert
			{{ Session::get('alert-class', 'alert-info') }}">{{Session::get('message') }}
		</p>
	@endif

	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				@if( count($admins) == 0 )
				<h1>No admins found</h1>
				@else
				<h1>Showing admins</h1>
				@endif
			</div>
		</div>
	</div>
	
	<div class="row">
		<!-- Left column -->
		<div class="col-md-6">
			<div class="admins">
				@if( count($admins) >= 1 )
				<ul>
					@foreach( $admins as $admin )
					<li>
						<a href="{{ url('admin/admins/'.$admin->id) }}">{{ $admin->name }}</a>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>

		<!-- Right column -->
		<div class="col-md-6">
			<div class="links">
				<div class="grey-nav-link">
					<a href="{{ url('admin/admins/create') }}">Create New Admin</a>
				</div>
			</div>
		</div>
	</div>
	
	{{ $admins->links() }}
</div>
@endsection