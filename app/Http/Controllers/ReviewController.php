<?php

// app/Http/Controllers/ReviewController.php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
  public function index()
  {
    $reviews = Review::with(['user', 'booking'])->get();
    return view('reviews', compact('reviews'));
  }

  public function create()
  {
    $userBookings = auth()->user()->bookings;

    return view('user.reviews.create', compact('userBookings'));
  }

  public function store(Request $request)
  {
    // Validate the request data
    $request->validate([
      'title' => 'nullable|string|max:255',
      'content' => 'required|string',
    ]);

    // Get the authenticated user's ID
    $userId = Auth::id();

    // You can get the booking ID from the form or another source based on your application logic
    // For now, I assume you have a 'booking_id' field in the form
    $bookingId = $request->input('booking_id');

    // Create a new review
    Review::create([
      'user_id' => $userId,
      'booking_id' => $bookingId,
      'title' => $request->input('title'),
      'content' => $request->input('content'),
      // Add other fields as needed
    ]);

    return redirect()->route('reviews')->with('success', 'Review created successfully');
  }

  public function destroy($id)
  {
    $review = Review::findOrFail($id);
    $review->delete();

    return redirect()->back()->with('success', 'Review deleted successfully');
  }
}
