@extends('layouts.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid otherpages">
  <div class="row">
    <!-- Sidebar -->
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
      <div class="position-sticky">
        <p class="mb-4 text-center dashboard-name">Admin Dashboard</p>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link mb-3" href="{{ route('admin.dashboard.index') }}">
              <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mb-3 ajax-link" href="{{ route('admin.dashboard.view-packages') }}">
              <i class="bi bi-box me-2"></i> View Packages
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mb-3 ajax-link" href="{{ route('admin.dashboard.create-package') }}">
              <i class="bi bi-box-arrow-up me-2"></i> Create Package
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mb-3 ajax-link" href="{{ route('admin.dashboard.view-bookings') }}">
              <i class="bi bi-calendar me-2"></i> View Bookings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mb-3 ajax-link" href="{{ route('admin.dashboard.view-support') }}">
              <i class="bi bi-question-circle me-2"></i> View Support
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mb-3 ajax-link" href="{{ route('admin.dashboard.view-users-ajax') }}">
              <i class="bi bi-person me-2"></i> View Users
            </a>
          </li>
          <!-- Add more nav items for other admin routes as needed -->
        </ul>
      </div>
    </nav>

    <!-- Content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="container pages-content mt-5" id="content-section">
        <!-- Content loaded through Ajax will be placed here -->
      </div>
    </main>
  </div>
</div>
@endsection
