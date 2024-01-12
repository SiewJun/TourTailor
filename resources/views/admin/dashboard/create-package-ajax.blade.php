<h1><i class="bi bi-box-arrow-up me-2"></i> Create Package</h1>
<hr>
<form id="create-package-form" class="mt-5" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" required>
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date" required>
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" id="location" name="location" required>
    </div>

    <div class="mb-3">
        <label for="cover_image" class="form-label">Cover Image</label>
        <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" required>
    </div>

    <div class="mb-3 form-check">
        <input type="hidden" name="featured" value="0"> <!-- Hidden input for false value -->
        <input type="checkbox" class="form-check-input" id="featured" name="featured" value="1">
        <label class="form-check-label" for="featured">Featured</label>
    </div>

    <!-- Add more form fields as needed -->

    <button type="submit" class="btn btn-primary">Create Package</button>
</form>

<script>
    $(document).ready(function () {
        $('#create-package-form').submit(function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Perform AJAX request
            $.ajax({
                url: "{{ route('admin.dashboard.store-package') }}",
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    // Handle the success response
                    console.log(response);
                },
                error: function (error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        });
    });
</script>