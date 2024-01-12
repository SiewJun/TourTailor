<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'TourTailor')</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Google Fonts Icon -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body class="antialiased flex flex-col min-h-screen">
  
  @include('partials.navbar') <!-- Include the navbar section -->

  @yield('content')

  <footer class="mt-auto py-5" style=" background: linear-gradient(to right, #ffffff, #d3d3d3);">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h5>Contact Us</h5>
          <p>Email: info@tourtailor.com</p>
          <p>Phone: +1 (555) 123-4567</p>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h5>Follow Us</h5>
          <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-instagram"></i></a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h5>Newsletter</h5>
          <p>Subscribe to our newsletter for updates.</p>
          <form>
            <div class="input-group">
              <input type="email" class="form-control" placeholder="Your email" aria-label="Your email"
                aria-describedby="button-addon2">
              <button class="btn btn-light" type="button" id="button-addon2">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </footer>

  <!-- Stripe -->
  <script src="https://js.stripe.com/v3/"></script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

  <script>

    // Change the background color and text color on scroll
    document.addEventListener('DOMContentLoaded', function () {
      const navbar = document.querySelector('.navbar');

      window.addEventListener('scroll', function () {
        const scrollPosition = window.scrollY;
        const isHomeNavbar = navbar.classList.contains('home-navbar');

        if (isHomeNavbar) {
          if (scrollPosition > 150) {
            navbar.style.backgroundColor = '#c5dbf2';
            navbar.classList.remove('navbar-dark');
            navbar.classList.add('navbar-light');
          } else {
            navbar.style.backgroundColor = 'transparent';
            navbar.classList.remove('navbar-light');
            navbar.classList.add('navbar-dark');
          }
        }
      });
    })

    // Handle AJAX requests
    $(document).ready(function () {
      $(".ajax-link").on("click", function (e) {
        e.preventDefault();

        var url = $(this).attr("href");

        $.ajax({
          url: url,
          method: "GET",
          success: function (response) {
            $(".pages-content").html(response);
          },
          error: function (xhr, status, error) {
            console.error("AJAX Request Failed: " + status, error);
          }
        });
      });
    });

  </script>

</body>

</html>