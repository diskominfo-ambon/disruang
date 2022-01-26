<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Schedule;
use Illuminate\Support\Facades\Response;

class SchedulesController extends Controller
{
  public function index(Request $request)
  {
    // get values in filter query string by month & year.
    [$month, $year] = [
      $request->get('month', 1),
      $request->get('year', date('Y')),
    ];

    $schedules = Schedule::withoutGlobalScopes()
      ->with(['room:id,name', 'user:id,name,phone_number'])
      ->whereMonth('started_at', $month)
      ->whereYear('started_at', $year)
      ->get();


    return Response::payload($schedules);
  }
}
