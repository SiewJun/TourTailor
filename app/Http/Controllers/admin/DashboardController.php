<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DiscoverController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Package;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function viewUsers()
    {
        $users = User::all(); // Assuming you have a User model

        return view('admin.dashboard.view-users-ajax', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // You can customize the response based on your needs
        return response()->json([
            'message' => 'User deleted successfully',
            'userId' => $id,
        ]);
    }

    public function viewPackages()
    {
        $packages = Package::all();
        return view('admin.dashboard.view-packages-ajax', compact('packages'));
    }

    public function createPackage()
    {
        // Implement logic to show the package creation form
        return view('admin.dashboard.create-package-ajax');
    }

    public function storePackage(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string',
            'cover_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'boolean',
            // Add validation for other fields as needed
        ]);

        // Handle file upload for the cover image
        $coverImage = $request->file('cover_image');
        $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
        $coverImage->move(public_path('cover'), $coverImageName);

        // Add the cover image name to the validated data
        $validatedData['cover_image'] = $coverImageName;

        // Add user_id to the validated data
        $validatedData['user_id'] = Auth::id();

        // Create a new package
        $package = Package::create($validatedData);
    }


    public function editPackage($id)
    {
        $package = Package::findOrFail($id);

        // Return the HTML content directly
        return view('admin.dashboard.edit-package-ajax', compact('package'));
    }

    public function updatePackage(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string',
            'cover_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'boolean',
        ]);

        $package = Package::findOrFail($id);

        // Handle file upload for the cover image
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
            $coverImage->move(public_path('cover'), $coverImageName);

            // Update the cover image name in the package data
            $package->cover_image = $coverImageName;
        }

        // Update other package details
        $package->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'location' => $request->input('location'),
            'featured' => $request->boolean('featured'), // Use boolean cast to interpret the checkbox state
        ]);

        // Redirect back to the view-packages page or return a JSON response
        return redirect()->route('admin.dashboard.index')->with('success', 'Package updated successfully');
    }

    public function deletePackage($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        // You can customize the response based on your needs
        return response()->json([
            'message' => 'Package deleted successfully',
            'packageId' => $id,
        ]);
    }

    public function viewBookings()
    {
        $bookings = Booking::all(); // Fetch all bookings

        return view('admin.dashboard.view-bookings-ajax', compact('bookings'));
    }

    public function getFeaturedPackages()
    {
        $featuredPackages = Package::where('featured', true)->get();
        return view('welcome', compact('featuredPackages'));

    }
    // Other admin-related methods...
}
