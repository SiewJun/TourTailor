<?php

namespace App\Http\Controllers;

use App\Models\TravelTip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TravelTipController extends Controller
{
    public function index()
    {
        $travelTips = TravelTip::all();
        return view('travel-tips.index', compact('travelTips'));
    }

    public function show($id)
    {
        $travelTip = TravelTip::findOrFail($id);
        return view('travel-tips.show', compact('travelTip'));
    }

    public function create()
    {
        return view('user.travel-tips.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'categories' => 'nullable|string',
        ]);

        Auth::user()->travelTips()->create($request->all());

        return redirect()->route('travel-tips.index')->with('success', 'Travel Tip created successfully');
    }

    public function destroy($id)
    {
        // Find the travel tip
        $travelTip = TravelTip::findOrFail($id);

        // Check if the authenticated user is an admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Delete the travel tip
            $travelTip->delete();

            // Redirect back with success message
            return redirect()->route('travel-tips.index')->with('success', 'Travel Tip deleted successfully');
        } else {
            // If not an admin, redirect back with error message
            return redirect()->route('travel-tips.index')->with('error', 'You do not have permission to delete this travel tip');
        }
    }
}