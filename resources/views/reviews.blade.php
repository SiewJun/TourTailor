@extends('layouts.layout')

@section('content')
<div class="container pages-content mt-5">
    <h1><i class="bi bi-star me-2"></i> Reviews</h1>

    <div class="mb-4 d-flex justify-content-end">
        @if(auth()->check() && auth()->user()->role === 'user')
        <a href="{{ route('user.reviews.create') }}" class="btn btn-primary">Create Review</a>
        @endif
    </div>
    <hr>

    @if($reviews->count() > 0)
    @foreach($reviews as $review)
    <div class="card mb-4">
        <div class="card-header">
        <h3 class="text-primary">Package: {{ $review->booking->cart->package->title }}</h3>
            <h5 class="card-title mb-0">{{ $review->title }}</h5>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $review->content }}</p>

            <!-- User information and submitted time -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="card-text">
                    <small class="text-muted">By User: {{ $review->user->profile->name }}</small>
                </p>
                <p class="card-text">
                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                </p>
            </div>

            <!-- Check if the user is an admin before showing the delete button -->
            @if(auth()->check() && auth()->user()->role === 'admin')
            <form method="post" action="{{ route('reviews.destroy', $review->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Review</button>
            </form>
            @endif
        </div>
    </div>
    @endforeach
    @else
    <div class="alert alert-info" role="alert">
        <strong>No reviews available at the moment.</strong>
    </div>
    @endif
</div>
@endsection