@extends('layouts.layout')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create Review</div>

        <div class="card-body">
          <form method="POST" action="{{ route('user.reviews.store') }}">
            @csrf

            <div class="form-group">
              <label for="booking_id">Select Booking:</label>
              <select name="booking_id" id="booking_id" class="form-control" required>
                @foreach($userBookings as $booking)
                <option value="{{ $booking->id }}">
                  {{ optional($booking->cart->package)->title }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
              <label for="content">Review Content:</label>
              <textarea name="content" id="content" class="form-control" required>{{ old('content') }}</textarea>
            </div>

            {{-- Add other fields as needed --}}

            <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary">Submit Review</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection