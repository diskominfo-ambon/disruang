<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function store(Request $request)
  {
    $credentials = $request->validate([
      'username' => 'required|exists:users,username',
      'password' => 'required'
    ]);

    if (!Auth::attempt($credentials)) {
      return redirect()
        ->back()
        ->with(
          'message.auth.error',
          "{$credentials['username']} memiliki kata sandi yang tidak valid."
        );
    }

    $user = Auth::user();

    if ($user->hasRole('admin')) {
      // to admin page
      return redirect()
        ->route('admin.home');
    }

    // to user page.
    return redirect()
      ->route('user.home');
  }
}
