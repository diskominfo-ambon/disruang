<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Schedule;

class HomeController extends Controller
{
  public function index()
  {
    $schedules = Auth::user()
      ->schedules()
      ->confirm()
      ->with(['participants', 'room'])
      ->get();

    return view('web::user.dashboards.home', compact('schedules'));
  }
}
