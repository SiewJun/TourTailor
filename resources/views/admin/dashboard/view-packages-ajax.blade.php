<div class="container mt-5" style="padding-left: 0px; padding-right: 0px;">
    <h1><i class="bi bi-box me-2"></i> View Packages</h1>
    @if($packages->isEmpty())
    <div class="alert alert-info" role="alert">
        No packages available.
    </div>
    @else
    <div class="mt-5">
    @foreach($packages as $package)
    <div class="card border-0 shadow-sm mb-3">
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
                    <h5 class="card-title mb-3 fw-bold">{{ $package->title }}</h5>
                    <ul class="list-unstyled">
                        <li class="mt-3"><strong>Description:</strong>
                            <p>{{ $package->description }}</p>
                        </li>
                        <li class="mt-3"><strong>Price:</strong>
                            <p>RM{{ number_format($package->price, 2) }}</p>
                        </li>
                        <li class="mt-3"><strong>Start Date:</strong>
                            <p>{{ $package->start_date }}</p>
                        </li>
                        <li class="mt-3"><strong>End Date:</strong>
                            <p>{{ $package->end_date }}</p>
                        </li>
                        <li class="mt-3"><strong>Location:</strong>
                            <p>{{ $package->location }}</p>
                        </li>
                        <!-- Add other package details as needed -->
                    </ul>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success me-2 btn-edit-package" data-package-id="{{ $package->id }}">Edit
                            Package</button>
                        <button class="btn btn-danger btn-delete-package" data-package-id="{{ $package->id }}"
                            data-csrf="{{ csrf_token() }}">Delete Package</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
@endif
</div>

<script>
    $(document).ready(function () {
        // AJAX request to fetch package details
        $('.btn-edit-package').click(function () {
            var packageId = $(this).data('package-id');

            $.ajax({
                url: '/admin/packages/' + packageId + '/edit',
                method: 'GET',
                dataType: 'html', // Update the dataType to 'html'
                success: function (data) {
                    // Update the content of the specific container with the edit-package view
                    $('.pages-content').html(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });

    $(document).ready(function () {
        // AJAX request to delete the package
        $('.btn-delete-package').click(function () {
            var packageId = $(this).data('package-id');
            var csrfToken = $(this).data('csrf');

            // Display a confirmation prompt
            var confirmDelete = confirm('Are you sure you want to delete this package?');

            if (confirmDelete) {
                // User confirmed, proceed with the delete request
                $.ajax({
                    url: '/admin/packages/' + packageId + '/delete',
                    method: 'DELETE',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    success: function (data) {
                        // Handle success, e.g., remove the deleted package from the view
                        // You may also consider refreshing the entire package list
                        // based on your application structure
                        console.log(data);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        });
    });
</script>