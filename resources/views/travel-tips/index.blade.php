@extends('layouts.layout')

@section('content')
<div class="container pages-content mt-5">
  <h1><i class="bi bi-globe me-2"></i> Travel Tips</h1>

  @if(auth()->check() && auth()->user()->role === 'user')
  <div class="mb-4 d-flex justify-content-end">
    <a href="{{ route('user.travel-tips.create') }}" class="btn btn-primary">Create Travel Tip</a>
  </div>
  @endif
  <hr>

  @if($travelTips->count() > 0)
  <div class="row row-cols-1 row-cols-md-2 g-4">
    @foreach($travelTips as $travelTip)
    <div class="col mb-3">
      <div class="card">
        <div class="card-body">
          <a href="{{ route('travel-tips.show', $travelTip->id) }}" class="text-decoration-none">
            <h5 class="card-title">{{ $travelTip->title }}</h5>
          </a>
          <p class="card-text">
            <small class="text-muted">By User: {{ $travelTip->user->name }}</small>
          </p>
          <p class="card-text">
            <small class="text-muted">Created {{ $travelTip->created_at->diffForHumans() }}</small>
          </p>

          <!-- Check if the user is an admin before showing the delete button -->
          @if(auth()->check() && auth()->user()->role === 'admin')
          <form method="post" action="{{ route('admin.travel-tips.destroy', $travelTip->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Travel Tip</button>
          </form>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <div class="alert alert-info mt-4" role="alert">
    <strong>No travel tips at the moment. Wait for users to contribute!</strong>
  </div>
  @endif
</div>
@endsection