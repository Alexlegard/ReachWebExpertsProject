@extends('layouts.store-layout')

@section('content')

@component('components.breadcrumbs')
	<a href="/">About</a>
@endcomponent

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="about-this-website" style="margin-top:2em;">
				<p>This is a personal portfolio website that I used to learn how to use Laravel. It's not a real store and credit cards will not be charged. Company logos are used for learning purposes.</p>

				<p>Please visit my website, <a href="https://www.alexlegard.ca/">alexlegard.ca</a> to see the rest of my work.</p>
			</div>
			
			
		</div>
	</div>
</div>
@endsection