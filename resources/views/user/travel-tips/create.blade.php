@extends('layouts.layout')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create Travel Tip</div>

        <div class="card-body">
          <form method="POST" action="{{ route('user.travel-tips.store') }}">
            @csrf

            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
              <label for="content">Travel Tip Content:</label>
              <textarea name="content" id="content" class="form-control" required>{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
              <label for="categories">Categories (optional):</label>
              <input type="text" name="categories" id="categories" class="form-control" value="{{ old('categories') }}">
            </div>

            {{-- Add other fields as needed --}}

            <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary">Submit Travel Tip</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection