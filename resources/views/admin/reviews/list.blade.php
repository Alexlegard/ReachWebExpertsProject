@extends('adminlte::page')

@section('content')
<div class="container">
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
				@foreach($reviews as $review)
					<li>
						<a href="{{ url('admin/my-reviews/' . $review->id) }}">
							Posted by {{ $review->user->name }} on {{ $review->restaurant->name }}:
						</a>
						<p>{{ $review->content }}</p>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
	
	
	{{ $reviews->links() }}
</div>
@endsection