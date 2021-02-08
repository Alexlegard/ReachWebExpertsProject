@extends('layouts.store-layout')

@section('content')
<div id="app">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thank you!</div>

                    <div class="card-body">
						<p>{{ session()->get('success_message') }}</p>
					
						<div class="yellow-action-link">
							<a href="{{ url('/') }}">Continue Shopping</a>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection