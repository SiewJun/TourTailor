@extends('layouts.layout')

@section('title', 'Home')

@section('content')
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header bg-primary text-white">Home</div>

				<div class="card-body">
					<p class="lead">Welcome! You are logged in as {{ auth()->user()->name }}.</p>

					@if(auth()->user()->role === 'admin')
					<div class="alert alert-info mt-4" role="alert">
						<strong>You have admin privileges.</strong>
					</div>
					@elseif(auth()->user()->role === 'user')
					<div class="alert alert-success mt-4" role="alert">
						<strong>Welcome to TourTailor! Enjoy your booking experience.</strong>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection