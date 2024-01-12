<!-- view-cart-ajax.blade.php -->

<div id="ajax-content">
  <h1><i class="bi bi-cart me-2"></i> Shopping Cart</h1>

  @if($cartItems->count() > 0)
  <table class="table">
    <thead>
      <tr>
        <th>Cover Image</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th>Selected Pax</th>
        <th>Location</th>
        <th>Total Amount</th>
        <th>Action</th> <!-- New column for the delete button -->
      </tr>
    </thead>
    <tbody>
      @foreach($cartItems as $cartItem)
      <tr>
        <td>
          <img src="{{ asset('cover/' . $cartItem->package->cover_image) }}" alt="{{ $cartItem->package->title }}"
            style="max-width: 100px; max-height: 100px; object-fit: cover;">
        </td>
        <td>{{ $cartItem->package->title }}</td>
        <td>{{ $cartItem->package->description }}</td>
        <td>RM{{ number_format($cartItem->package->price, 2) }}</td>
        <td>{{ $cartItem->selected_pax }}</td>
        <td>{{ $cartItem->package->location }}</td>
        <td>RM{{ number_format($cartItem->package->price * $cartItem->selected_pax, 2) }}</td>
        <td>
          <button type="button" class="btn btn-danger" onclick="deleteCartItem({{ $cartItem->id }})">Delete</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="total-amount text-end">
    <strong>Total Amount:</strong> RM{{ number_format($totalAmount, 2) }}
  </div>

  <div class="text-center mt-3 float-end">
    <button id="checkoutButton" class="btn btn-primary">Pay Now</button>
  </div>

  @else
  <div class="alert alert-info" role="alert">
    Your cart is empty.
  </div>
  @endif
</div>

<script>
  document.getElementById('checkoutButton').addEventListener('click', function () {
    window.location.href = "{{ route('checkout') }}";
  });

  function deleteCartItem(cartItemId) {
    if (confirm('Are you sure you want to delete this item from your cart?')) {
        // Implement AJAX to delete the cart item
        fetch(`{{ route('user.dashboard.delete-cart-item', '__cartItemId__') }}`.replace('__cartItemId__', cartItemId), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (response.ok) {
                // Reload the page or update the cart content after successful deletion
                location.reload();
            } else {
                // Handle non-JSON response (e.g., HTML error page)
                console.error('Failed to delete cart item. Serned non-JSON response.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}



</script>