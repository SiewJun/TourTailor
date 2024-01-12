@extends('layouts.layout')

@section('content')
<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      <h2>{{ $travelTip->title }}</h2>
    </div>
    <div class="card-body">
      <p class="card-text">{{ $travelTip->content }}</p>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>Categories:</strong> {{ $travelTip->categories ?: 'Not specified' }}</li>
        <li class="list-group-item"><strong>Created by:</strong> {{ $travelTip->user->name }}</li>
      </ul>
    </div>
    <div class="card-footer text-muted">
      <li class="list-group-item"><strong>Created:</strong> {{ $travelTip->created_at->diffForHumans() }}</li>
    </div>
  </div>
</div>
@endsection