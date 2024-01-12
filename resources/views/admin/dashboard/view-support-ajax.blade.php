<div class="mt-5">
  @if($supportMessages->isEmpty())
  <div class="alert alert-info" role="alert">
    No support messages found.
  </div>
  @else
  @foreach($supportMessages as $message)
  <div class="card mb-4 border-0 shadow-sm">
    <div class="card-body">
      <h2>Support Message From:</h2>
      <p class="card-title"><strong>{{ $message->user->name }}</strong></p>
      <p class="card-text"><strong>Email:</strong> {{ $message->user->email }}</p>
      <p class="card-text"><strong>Message:</strong> {{ $message->message }}</p>
      <p class="card-text"><strong>Created At:</strong> {{ $message->created_at }}</p>
      <!-- Add other information as needed -->
      <form action="{{ route('admin.dashboard.delete-support', $message->id) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
    </div>
  </div>
  @endforeach
  @endif
</div>

<script>
  $(document).ready(function () {
    // Ajax link click event
    $(".ajax-link").on("click", function (e) {
      e.preventDefault();
      var url = $(this).attr("href");
      loadAjaxContent(url, '.pages-content');
    });

    // Function to load Ajax content
    function loadAjaxContent(url, target) {
      $.ajax({
        url: url,
        method: 'GET',
        dataType: 'html',
        success: function (data) {
          $(target).html(data);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Request Failed:", status, xhr.responseText);
        }
      });
    }
  });
</script>