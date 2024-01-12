<div class="container">
  <h1 class="display-4"></h1>
  <h1><i class="bi bi-calendar me-2 mt-5"></i> All Bookings</h1>
  <hr>
  @if($bookings->count() > 0)
  <div class="mt-5">
    @foreach($bookings as $booking)
    <div class="card mb-4 border-0 shadow-sm">
      <div class="card-header">
        <h5 class="card-title mb-0">{{ $booking->cart->package->title }}</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <img src="{{ asset('cover/' . $booking->cart->package->cover_image) }}" alt="Package Image"
              class="img-fluid rounded" style="max-height: 200px; max-width: 200px;">
          </div>
          <div class="col-md-6">
            <ul class="list-group">
              <li class="list-group-item"><strong>User:</strong> {{ $booking->user->name }}</li>
              <li class="list-group-item"><strong>Start Date:</strong> {{
                $booking->cart->package->start_date
                }}</li>
              <li class="list-group-item"><strong>End Date:</strong> {{ $booking->cart->package->end_date
                }}
              </li>
              <li class="list-group-item"><strong>Selected Pax:</strong> {{ $booking->cart->selected_pax
                }}
              </li>
              <li class="list-group-item"><strong>Booking Date:</strong> {{ $booking->booking_date }}</li>

              <!-- Display amount from payment_cart -->
              <li class="list-group-item"><strong>Amount Paid:</strong> {{
                $booking->cart->paymentCart->amount
                ?? 'Not available' }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <div class="alert alert-info" role="alert">
    <strong>No bookings available.</strong>
  </div>
  @endif
</div>

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
          $("#admin-bookings-content").html(data);
        },
        error: function (xhr, status, error) {
          console.error(xhr.respons       }
      });
    }
  });
</script>