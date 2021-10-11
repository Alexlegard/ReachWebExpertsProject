@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('js')
<script>
	function ConfirmDelete(){
		if(!confirm("Are you sure you want to delete this selection?"))
		event.preventDefault();
	}
</script>
@endsection

@section('content')

<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>{{ $selection->name }} option</h1>
			</div>	
			<h5>{{ $dish->name }}</h5>
		</div>
	</div>

	<div class="row">
		<div class="col-6">
			@if( $selection->radio_or_checkbox == 'radio' )
			<div>Customer can choose one option.</div>
			@else
			<div>Customer can choose multiple options.</div>
			@endif
			
			@if( count($selection->options) >= 1 )
			<ul>
				@foreach($selection->options as $option)
				<li>{{ $option }}</li>
				@endforeach
			</ul>
			@endif
		</div>
		
		<div class="col-6">
			<div class="links">
				<div class="yellow-action-link">
					<a href="{{ url('admin/my-selections/'.$selection->id.'/edit') }}">Edit this selection</a>
				</div>
				<div class="grey-nav-link">
					<a href="{{ url('admin/my-dishes/'.$dish->id) }}">Back to dish</a>
				</div>

				<form class="delete-form" method="post" action="{{ url('admin/my-selections/'. $selection->id) }}">
					@csrf
					@method('DELETE')
					<input type="submit" value="Delete this selection" onclick="return ConfirmDelete();">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection