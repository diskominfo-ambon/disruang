<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
  public function store()
  {
    Auth::logout();

    return redirect()
      ->route('auth.login');
  }
}
