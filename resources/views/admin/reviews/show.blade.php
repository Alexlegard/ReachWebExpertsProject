@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('js')
<script>
	function ConfirmDelete(){
		if(!confirm("Are you sure to delete this review?"))
		event.preventDefault();
	}
</script>
@endsection


@section('content')
<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="breadcrumbs">
				<a href="{{ url('admin/my-reviews') }}">Reviews</a>
				<i class="fas fa-arrow-right"></i>
				<span>Review</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Review</h1>
			</div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-6">
			<div class="review-details">
				<p><b>User:</b> {{ $review->user->name }}</p>
				<p><b>Time submitted:</b> {{ $review->time_submitted }}</p>
				<p>{{ $review->content }}</p>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="grey-nav-link">
				<a href="{{ url('admin/my-reviews') }}">Back to List</a>
			</div>
			<form class="delete-form" method="post" action="{{ url('admin/my-reviews/'. $review->id) }}">
				@csrf
				@method('DELETE')
				<input type="submit" value="Delete this review" onclick="return ConfirmDelete();">
			</form>
		</div>
	</div>
</div>
@endsection