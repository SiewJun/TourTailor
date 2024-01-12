<nav
  class="navbar navbar-expand-lg {{ Request::is('/') ? 'home-navbar navbar-dark fixed-top' : '' }} navbar-black other-navbar">
  <div class="container-fluid">
    <a class="navbar-brand logo" href="{{ url('/') }}">
      <img src="{{ asset('img/tourtailorlogo.png') }}" alt="TourTailor Logo" />
    </a>

    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav ml-auto nav-underline">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('discover') ? 'active' : '' }}" href="{{ url('/discover') }}">Discover</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('blog') ? 'active' : '' }}" href="{{ route('travel-tips.index') }}">Blog/Travel Tips</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('reviews-ratings') ? 'active' : '' }}"
          href="{{ route('reviews') }}">Reviews & Ratings</a>
        </li>
        @guest
        @if (Route::has('login'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        @if(Auth::user()->role != 'admin')
        <li class="nav-item">
          <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}"
          href="{{ route('user.support.index') }}">Contact/Support</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.dashboard.index') }}">
            <i class="fa fa-shopping-cart" style="font-size:20px"></i>
          </a>
        </li>
        @endif
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" 
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            @if(Auth::user()->role == 'admin')
            <a class="dropdown-item" href="{{ route('admin.account.index') }}">
              Admin Account Management
            </a>
            <a class="dropdown-item" href="{{ route('admin.dashboard.index') }}">
              Admin Dashboard
            </a>
            @else
            <a class="dropdown-item" href="{{ route('user.account.index') }}">
              User Account Management
            </a>
            <a class="dropdown-item" href="{{ route('user.dashboard.index') }}">
              User Dashboard
            </a>
            @endif
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>