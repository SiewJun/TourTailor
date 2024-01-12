@extends('layouts.layout')

@section('title', 'User Edit Account')

@section('content')
<div class="container pages-content mt-5">
  <h1>User Edit Account</h1>

  <form class="mt-5" method="POST" action="{{ route('user.account.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Existing Fields -->
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
    </div>

    <div class="mb-3">
      <label for="nric" class="form-label">NRIC</label>
      <input type="text" class="form-control" id="nric" name="nric" placeholder="xxxx-xx-xxxx"
        value="{{ $user->profile->nric }}">
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <textarea class="form-control" id="address" name="address">{{ $user->profile->address }}</textarea>
    </div>

    <!-- New Fields -->
    <div class="mb-3">
      <label for="avatar" class="form-label">Avatar</label>
      <input type="file" class="form-control" id="avatar" name="avatar">
    </div>

    <div class="mb-3">
      <label for="phone" class="form-label">Phone</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="xxx-xxxxxxx"
        value="{{ $user->profile->phone }}">
    </div>

    <div class="mb-3">
      <label for="birthdate" class="form-label">Birthdate</label>
      <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $user->profile->birthdate }}">
    </div>

    <!-- Password Fields Toggle Button -->
    <button type="button" class="btn btn-primary" onclick="togglePasswordFields()">Change Password</button>

    <!-- Password Fields (Initially Hidden) -->
    <div id="passwordFields" style="display: none;">
      <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password" required>
      </div>

      <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
      </div>

      <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
      </div>
    </div>
    <!-- Add other input fields as needed -->

    <button type="submit" class="btn btn-primary">Update Profile</button>
  </form>

  <script>
    function togglePasswordFields() {
      var passwordFields = document.getElementById('passwordFields');
      passwordFields.style.display = passwordFields.style.display === 'none' ? 'block' : 'none';

      // Set 'required' attribute for password fields when displayed
      var currentPasswordField = document.getElementById('current_password');
      var newPasswordField = document.getElementById('new_password');
      var confirmPasswordField = document.getElementById('confirm_password');

      if (passwordFields.style.display === 'block') {
        currentPasswordField.setAttribute('required', 'required');
        newPasswordField.setAttribute('required', 'required');
        confirmPasswordField.setAttribute('required', 'required');
      } else {
        currentPasswordField.removeAttribute('required');
        newPasswordField.removeAttribute('required');
        confirmPasswordField.removeAttribute('required');
      }
    }
  </script>
  @endsection