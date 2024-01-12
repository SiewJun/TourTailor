@extends('layouts.layout')

@section('title', 'Admin Account Management')

@section('content')
<div class="container pages-content mt-5">
  <h1 class="mb-4">Admin Account Management</h1>

  <div class="row mb-4 mt-5">
    <div class="col-lg-4">
      <div class="card mb-4 h-100">
        <div class="card-body text-center">
          @if($user->profile->avatar)
          <img src="{{ asset('avatars/' . $user->profile->avatar) }}" alt="avatar"
            class="rounded-circle img-fluid mx-auto d-block mb-3" style="width: 250px; height: 250px;">
          @else
          <img src="{{ asset('img/catvomit.png') }}" alt="avatar" class="rounded-circle img-fluid mx-auto d-block mb-3"
            style="width: 250px; height: 250px;">
          @endif
          <h5 class="mb-2 mt-5">{{ $user->name }}</h5>
          <p class="text-muted mb-1">{{ $user->role }}</p>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card mb-4 h-100">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0 font-weight-bold">Full Name</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ $user->name }}</p>
            </div>
          </div>

          <hr>

          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0 font-weight-bold">Email</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ $user->email }}</p>
            </div>
          </div>

          <hr>

          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0 font-weight-bold">Phone</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ $user->profile->phone }}</p>
            </div>
          </div>

          <hr>

          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0 font-weight-bold">Address</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ $user->profile->address }}</p>
            </div>
          </div>

          <hr>

          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0 font-weight-bold">Birthdate</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ $user->profile->birthdate }}</p>
            </div>
          </div>

          <hr>

          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0 font-weight-bold">NRIC</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ $user->profile->nric }}</p>
            </div>
          </div>

          <hr>

          <div class="row mb-3">
            <div class="col-sm-3">
              <p class="mb-0 font-weight-bold">User Since</p>
            </div>
            <div class="col-sm-9">
              <p class="text-muted mb-0">{{ $user->created_at }}</p>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-sm-12">
              <a href="{{ route('admin.account.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection