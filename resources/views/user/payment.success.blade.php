<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Optional: Include your custom styles if needed -->
    <!-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> -->
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Payment Successful</h5>
            <p class="card-text">Thank you for your purchase!</p>
            <a href="{{ route('user.dashboard.index') }}" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
