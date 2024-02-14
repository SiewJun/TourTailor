<!-- view-users-ajax.blade.php -->
@foreach($users as $user)
  @if($user->role === 'user')
    <div class="card mb-3 user-record" data-user-id="{{ $user->id }}">
      <div class="card-body">
        <h5 class="card-title">{{ $user->name }}</h5>
        <p class="card-text">{{ $user->email }}</p>
        <!-- Add other user details as needed -->

        <!-- Add the delete button -->
        <button class="btn btn-danger delete-user" data-user-id="{{ $user->id }}">Delete</button>
      </div>
    </div>
  @endif
@endforeach

<script>
  // JavaScript code for handling Ajax request
  $(document).ready(function () {
    // Event handler for delete button
    $('.delete-user').on('click', function () {
      var userId = $(this).data('user-id');

      if (confirm('Are you sure you want to delete this user?')) {
        // Make an Ajax request to delete the user
        $.ajax({
          url: '{{ route('admin.users.delete', ['id' => ':id']) }}'.replace(':id', userId),
          type: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
            // Remove the deleted user's card from the view
            $('.user-record[data-user-id="' + userId + '"]').remove();
            // Show a success message
            alert(data.message);
          },
          error: function (xhr, status, error) {
            console.error(error);
            // Show an error message
            alert('Error deleting user');
          }
        });
      }
    });
  });
</script>
