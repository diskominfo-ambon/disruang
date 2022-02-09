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
    // get values in filter query string by year.
    $year = $request->get('year', date('Y'));
    $currentMonth = (int)date('m');
    $months = [];
    $rangeMonth = 3;

    for($it = $currentMonth; $it < ($currentMonth + $rangeMonth); $it++) {
      if ($it > 12) break;

      $months[] = $it;
    }

    $values = preg_replace(
      '/\d/',
      '?',
      implode(',', $months)
    );

    $schedules = Schedule::withoutGlobalScopes()
      ->with(['room:id,name', 'user:id,name,phone_number'])
      ->whereRaw(
        <<<SQL
          MONTH(started_at) IN ($values)
        SQL  
        ,$months
      )
      ->whereYear('started_at', $year)
      ->get();

    return Response::payload($schedules);
  }
}
