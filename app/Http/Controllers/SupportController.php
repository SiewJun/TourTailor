<?php

namespace App\Http\Controllers;

use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
  public function index()
  {
    $userId = Auth::id();

    $supportMessages = SupportMessage::with('user')
      ->where('user_id', $userId)
      ->latest()
      ->get();

    return view('user.support.index', compact('supportMessages'));
  }

  public function create()
  {
    return view('user.support.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string',  // Add this line if 'name' is required
      'message' => 'required|string',
    ]);

    Auth::user()->supportMessages()->create([
      'name' => $request->input('name'),  // Add this line if 'name' is required
      'message' => $request->input('message'),
    ]);

    return redirect()->route('user.support.index')->with('success', 'Support message sent successfully.');
  }

}

