<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\User;


class AccountController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Load the user's profile with eager loading
        $user->load('profile');

        return view('user.account.index', compact('user'));
    }

    public function edit()
    {
        // Fetch the user's current profile details with eager loading
        $user = Auth::user()->load('profile');

        return view('user.account.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Validation rules for profile details update
        $rules = [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . auth()->id(),
            'nric' => 'nullable|string|regex:/\d{4}-\d{2}-\d{4}/',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for image upload
            'phone' => ['nullable', 'string', 'regex:/^\d{3}-\d{8}$|^\d{3}-\d{7}$/'],
            'birthdate' => 'nullable|date',
            // Add other fields and rules as needed
        ];

        // If a new password is provided, include password validation rules
        if ($request->filled('new_password')) {
            $rules['current_password'] = 'required|string';
            $rules['new_password'] = 'required|string|min:8|different:current_password';
            $rules['confirm_password'] = 'required|string|same:new_password';
        }

        // Validate the request data
        $request->validate($rules);

        // Update the user's profile details
        $user = Auth::user();
        $user->update($request->only(['name', 'email', 'age', 'nric', 'address']));

        // Update or create the user's profile
        $profileData = [
            'nric' => $request->input('nric'),
            'address' => $request->input('address'),
            'avatar' => $request->input('avatar'), // Assuming 'avatar' is a field in the Profile model
            'phone' => $request->input('phone'),
            'birthdate' => $request->input('birthdate'),
            // Add other profile fields as needed
        ];

        // Check if avatar file is provided
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = $avatar->getClientOriginalName();
            $avatar->move(public_path('avatars'), $avatarName);
            $profileData['avatar'] = $avatarName;
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        // If a new password is provided, update the password
        if ($request->filled('new_password')) {
            // Check if the current password matches
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->route('user.account.edit')->with('error', 'Current password is incorrect.');
            }

            // Update the password
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
        }

        return redirect()->route('user.account.index')->with('success', 'Profile details updated successfully.');
    }
    // Other methods for additional functionality like changing password, etc.
}

