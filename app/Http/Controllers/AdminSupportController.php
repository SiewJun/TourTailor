<?php

// AdminSupportController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportMessage;

class AdminSupportController extends Controller
{
  public function index()
  {
    $supportMessages = SupportMessage::with('user')->latest()->get();

    return view('admin.dashboard.view-support-ajax', compact('supportMessages'));
  }

  public function destroy($id)
  {
    $supportMessage = SupportMessage::findOrFail($id);
    $supportMessage->delete();

    return redirect()->route('admin.dashboard.index')->with('success', 'Support message deleted successfully');
  }
  // ... other admin-related support methods
}
