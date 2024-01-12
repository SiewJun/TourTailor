@extends('layouts.layout')

@section('title', 'Welcome')

@section('content')
<div class="welcome">
  <div class="hero-video-container">
    <video autoplay loop muted>
      <source src="{{ asset('video/herovideo.mp4') }}" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="overlay">
      <div class="hero-text">
        <p>Welcome to TourTailor<br><span class="hero-p-size">Crafting Your Unforgettable Journey</span></p>
      </div>
    </div>
  </div>

  <div class="container mt-5 mb-5">
    <div class="featured-packages">
      <h2 class="fw-bold">Featured Packages</h2>
      <hr>
      @if($featuredPackages->isEmpty())
      <div class="alert alert-info mt-4" role="alert">
        <strong>No featured pack listing available yet. Please wait for admin updates.</strong>
      </div>
      @else
      <div class="row g-0 mt-4">
        @foreach($featuredPackages as $package)
        <div class="col-md-4 mb-3">
          <div class="card h-100 border-0 shadow-sm">
            <img src="{{ asset('cover/' . $package->cover_image) }}" class="bd-placeholder-img card-img-top"
              alt="{{ $package->title }}" style="object-fit: cover; height: 225px;">
            <div class="card-body d-flex flex-column">
              <h3>{{ $package->title }}</h3>
              <p class="card-text flex-grow-1">{{ $package->description }}</p>
              <p class="card-text">Price: RM{{ number_format($package->price, 2) }}</p>
              <div class="d-flex justify-content-between align-items-center mt-auto">
                <div class="btn-group">
                  <button class="nav-link {{ Request::is('discover') ? 'active' : '' }}">
                    <a href="{{ url('/discover') }}">View</a>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>

  <div class="about-us-container">
    <section class="about-us-section">
      <div class="about-us-content">
        <h1>About Us</h1>
        <p class="lead">At TourTailor, we are passionate about creating extraordinary travel experiences that leave a
          lasting impact. Our commitment is to tailor each journey with unique preferences, ensuring every moment is
          filled with wonder and discovery.</p>
        <div class="shining-part" style="top: 50px; left: 50px;"></div>
        <p>With a team of dedicated travel enthusiasts, we strive to redefine the way you explore the world. From
          breathtaking landscapes to immersive cultural encounters, TourTailor is your trusted partner in crafting
          personalized adventures that go beyond the ordinary.</p>
      </div>
      <div class="about-us-image">
        <img src="{{ asset('img/aboutus.png') }}" alt="About Us Image">
      </div>
    </section>
  </div>

</div>
@endsection