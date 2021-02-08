@extends('adminlte::page')

@section('content')
<h1>Reviews for {{ $reviews }}</h1>

<ul>
@foreach( $reviews as $review )
	<li>
		<a href="{{ url('admin/review/' . $review->id) }}">
			{{ $review->name }}
		</a>
	</li>
@endforeach
</ul>
@endsection