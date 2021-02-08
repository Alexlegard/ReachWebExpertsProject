@extends('adminlte::page')

@section('js')
<script>
	function ConfirmDelete(){
		if(!confirm("Are you sure you want to delete this review?"))
		event.preventDefault();
	}
</script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>Showing review</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
	
		<!-- Left column -->
		<div class="col-6">
			<table class="details-table">
				<tr>
					<td>Content</td>
					<td>{{ $review->content }}</td>
				</tr>
				<tr>
					<td>Time posted</td>
					<td>{{ $review->time_submitted }}</td>
				</tr>
				<tr>
					<td>Restaurant</td>
					<td>
						<a href="{{ url('admin/restaurants/'.$restaurant->id) }}">{{ $review->restaurant->name }}</a>
					</td>
				</tr>
				<tr>
					<td>User</td>
					<td>
						<a href="{{ url('admin/users/'.$review->user->id) }}">{{ $review->user->name }}</a>
					</td>
				</tr>
			</table>
		</div>
		
		<!-- Right column -->
		<div class="col-6">
			<div class="links">
				<div class="grey-nav-link">
					<a href="{{ url('admin/reviews') }}">Back to reviews</a>
				</div>
				<form class="delete-form" method="post" action="{{ url('admin/reviews/'. $review->id) }}">
					@csrf
					@method('DELETE')
					<input type="submit" value="Delete this review" onclick="return ConfirmDelete();">
				</form>
			</div>
		</div>
	</div>
</div>

@endsection