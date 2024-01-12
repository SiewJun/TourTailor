@extends('layouts.layout')

@section('content')
<div class="container pages-content mt-5">
    <h1><i class="bi bi-envelope me-2"></i> Support Messages</h1>
    
    <div class="mb-4 d-flex justify-content-end">
        <a href="{{ route('user.support.create') }}" class="btn btn-primary">Create Support Ticket</a>
    </div>
    <hr>
    
    @if($supportMessages->count() > 0)
    @foreach($supportMessages as $message)
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ $message->name }}</h5>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $message->message }}</p>
            <p class="card-text"><small class="text-muted">{{ $message->created_at->diffForHumans() }}</small></p>
        </div>
    </div>
    @endforeach
    @else
    <div class="alert alert-info" role="alert">
        <strong>No support messages available.</strong>
    </div>
    @endif
</div>
@endsection
