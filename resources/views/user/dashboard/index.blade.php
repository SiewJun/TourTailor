@extends('layouts.layout')

@section('title', 'User Dashboard')

@section('content')
<div class="container-fluid otherpages">
  <div class="row">
    <!-- Sidebar -->
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
      <div class="position-sticky">
        <p class="mb-4 text-center dashboard-name">User Dashboard</p>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link mb-3" href="{{ route('user.dashboard.index') }}">
              <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mb-3 ajax-link" href="{{ route('user.dashboard.view-cart-ajax') }}">
              <i class="bi bi-cart me-2"></i> View Cart
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mb-3 ajax-link" href="{{ route('user.dashboard.view-bookings-ajax') }}">
              <i class="bi bi-calendar me-2"></i> View Bookings
            </a>
          </li>
          <!-- Add more nav items for other user routes as needed -->
        </ul>
      </div>
    </nav>

    <!-- Content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="container pages-content mt-5">
        <div id="ajax-content">
          <!-- Content loaded dynamically through Ajax will be displayed here -->
        </div>
      </div>
    </main>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  $(document).ready(function () {
    // Ajax link click event
    $(".ajax-link").on("click", function (e) {
      e.preventDefault();
      var url = $(this).attr("href");
      loadAjaxContent(url);
    });

    // Function to load Ajax content
    function loadAjaxContent(url) {
      $.ajax({
        url: url,
        type: 'GET',
        success: function (data) {
          $("#ajax-content").html(data);
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
        }
      });
    }
  });
</script>

@endsection