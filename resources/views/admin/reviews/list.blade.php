@extends('adminlte::page')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/sass/main.css') }}" />
@endsection

@section('content')

@if($reviews->isEmpty())
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>No Reviews</h1>
			</div>
		</div>
	</div>
</div>
@else
<div class="container">

	<div class="row">
		<div class="col-12">
			<div class="breadcrumbs">
				<span>Reviews</span>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="header-large-blue">
				<h1>List of reviews</h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">
			<ul>
				<table class="details-table">
					<tr>
						<td>Restaurant</td>
						<td>Restaurant Address</td>
						<td>Reviewer</td>
						<td>Review</td>
					</tr>
					@foreach($reviews as $review)
					<tr>
						<td><a href="{{ url('admin/my-reviews/' . $review->id) }}">{{ $review->restaurant->name }}</a></td>
						<td><a href="{{ url('admin/my-reviews/' . $review->id) }}">{{ getAddress($review->restaurant); }}</a></td>
						<td><a href="{{ url('admin/my-reviews/' . $review->id) }}">{{ $review->user->name }}</a></td>
						<td><a href="{{ url('admin/my-reviews/' . $review->id) }}">{{ $review->content }}</a></td>
					</tr>
					@endforeach
				</table>


					<!--
					<li>
						<a href="{{ url('admin/my-reviews/' . $review->id) }}">
							Posted by {{ $review->user->name }} on {{ $review->restaurant->name }}:
						</a>
						<p>{{ $review->content }}</p>
					</li>-->
			</ul>
		</div>
	</div>
	
	
	{{ $reviews->links() }}
</div>
@endif

@endsection