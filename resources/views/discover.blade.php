@extends('layouts.layout')

@section('title', 'Discover')

@section('content')
<div class="container mt-5 mb-5">
  <h1><i class="bi bi-binoculars"></i> Discover Your Packages</h1>

  <form action="{{ route('discover.search') }}" method="GET" class="mb-4">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="form-group">
          <label for="query" class="form-label">Search for packages:</label>
          <input type="text" class="form-control" name="query" id="query" placeholder="Search for packages...">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="min_price" class="form-label">Min Price:</label>
          <input type="number" class="form-control" name="min_price" id="min_price" min="0">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="max_price" class="form-label">Max Price:</label>
          <input type="number" class="form-control" name="max_price" id="max_price" min="0">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="location" class="form-label">Location:</label>
          <select class="form-select" name="location" id="location">
            <option value="">Select Location</option>
            @foreach($locations as $location)
            <option value="{{ $location }}">{{ $location }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </div>
  </form>
  <hr>
  @if($packagesListing->count() > 0)
  <div class="row g-4 mt-4">
    @foreach($packagesListing as $package)
    <div class="col-md-6">
      <div class="card h-100 border-0 shadow-sm">
        <img src="{{ asset('cover/' . $package->cover_image) }}" class="card-img-top" alt="{{ $package->title }}"
          style="object-fit: cover; height: 225px;">
        <div class="card-body d-flex flex-column">
          <h3 class="card-title">{{ $package->title }}</h3>
          <p class="card-text flex-grow-1">{{ $package->description }}</p>
          <p class="card-text">Price: RM{{ number_format($package->price, 2) }}</p>
          <form method="post" action="{{ route('user.dashboard.add-to-cart', ['package' => $package->id]) }}">
            @csrf
            <div class="mb-3">
              <label for="selected_pax" class="form-label">Select Pax:</label>
              <div class="input-group">
                <input type="number" class="form-control" id="selected_pax" name="selected_pax" value="1" min="1"
                  required>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-auto">
              <div class="btn-group">
                <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <div class="alert alert-info mt-4" role="alert">
    <strong>No package listings available yet. Please wait for admin updates.</strong>
  </div>
  @endif
</div>
@endsection