@extends('layouts.store-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
					
					<div>
						<a href="{{ url('profile/'.Auth()->user()->id) }}">Visit profile</a>
					</div>
					
					@if (Gate::allows('is-admin'))
					<div>
						<a href="{{ url('admin') }}">Admin Dashboard</a>
					</div>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
