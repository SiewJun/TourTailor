<!-- edit-package-ajax.blade.php -->

<div class="container pages-content mt-5">
  <div class="card mb-3">
    <div class="row g-0">
      <div class="col-md-4">
        @if($package->cover_image)
        <img src="{{ asset('cover/' . $package->cover_image) }}" alt="{{ $package->title }}" class="img-fluid">
        @else
        <div class="bg-light text-center p-3">
          <p class="mb-0">No Image</p>
        </div>
        @endif
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <form action="{{ route('admin.dashboard.update-package', ['id' => $package->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h5 class="card-title mb-3 fw-bold">
              <input type="text" name="title" value="{{ $package->title }}" class="form-control" required>
            </h5>

            <ul class="list-unstyled">
              <li class="mt-3"><strong>Description:</strong>
                <textarea name="description" class="form-control" required>{{ $package->description }}</textarea>
              </li>
              <li class="mt-3"><strong>Price:</strong>
                <input type="text" name="price" value="{{ $package->price }}" class="form-control" required>
              </li>
              <li class="mt-3"><strong>Start Date:</strong>
                <input type="date" name="start_date" value="{{ $package->start_date }}" class="form-control" required>
              </li>
              <li class="mt-3"><strong>End Date:</strong>
                <input type="date" name="end_date" value="{{ $package->end_date }}" class="form-control" required>
              </li>
              <li class="mt-3"><strong>Location:</strong>
                <input type="text" name="location" value="{{ $package->location }}" class="form-control" required>
              </li>
              <li class="mt-3"><strong>Featured:</strong>
                <input type="hidden" name="featured" value="0">
                <input type="checkbox" name="featured" {{ $package->featured ? 'checked' : '' }} value="1">
              </li>
              <!-- Add other package details as needed -->
            </ul>
            <div class="mb-3">
              <label for="cover_image" class="form-label">Cover Image:</label>
              <input type="file" name="cover_image" class="form-control" accept="image/*">
            </div>
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-success me-2">Save Changes</button>
              <!-- Add other buttons or form elements for editing -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>