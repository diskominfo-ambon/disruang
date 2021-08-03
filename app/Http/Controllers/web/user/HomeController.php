<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Schedule;

class HomeController extends Controller
{
  public function index()
  {
    $schedules = Schedule::confirm()
      ->with(['participants', 'room'])
      ->get();

    return view('web::pages.user.dashboards.home', compact('schedules'));
  }
}
