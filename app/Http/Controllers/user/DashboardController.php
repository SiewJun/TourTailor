<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard.index');
    }

    public function viewCart()
    {
        // Retrieve cart items for the authenticated user
        $cartItems = Cart::where('user_id', auth()->id())->with('package')->get();

        // Calculate the total amount
        $totalAmount = $cartItems->sum(function ($cartItem) {
            return $cartItem->package->price * $cartItem->selected_pax;
        });

        return view('user.dashboard.view-cart-ajax', compact('cartItems', 'totalAmount'));
    }

    public function addToCart(Request $request, Package $package)
    {
        // Ensure only authenticated users can add to cart
        if (Auth::check() && Auth::user()->isRegularUser()) {
            // Validate the selected pax input
            $request->validate([
                'selected_pax' => 'required|integer|min:1',
            ]);

            $package = Package::findOrFail($package->id);

            $amount = $package->price * $request->input('selected_pax');

            $cartItem = new Cart([
                'user_id' => Auth::id(),
                'package_id' => $package->id,
                'selected_pax' => $request->input('selected_pax'),
            ]);

            // Save the cart item to the database
            $cartItem->save();

            return redirect()->back()->with('success', 'Package added to cart successfully.');

        }

        // If the user is not authenticated or is not a regular user, handle accordingly
        return redirect()->route('login')->with('error', 'You must be logged in as a regular user to add items to the cart.');
    }

    public function deleteCartItem(Cart $cartItem)
    {
        // Ensure the authenticated user owns the cart item
        if ($cartItem->user_id === auth()->id()) {
            $cartItem->delete();
            return response()->json(['message' => 'Cart item deleted successfully.']);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }


    public function viewBookings()
    {
        // Retrieve and return the bookings for the authenticated user
        $bookings = Booking::where('user_id', auth()->id())->get();

        return view('user.dashboard.view-bookings-ajax', compact('bookings'));
    }
}
