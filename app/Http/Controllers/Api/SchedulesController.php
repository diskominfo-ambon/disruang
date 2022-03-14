<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Schedule;
use App\Models\Participant;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class SchedulesController extends Controller
{
  public function index(Request $request)
  {
    // get values in filter query string by year.
    $year = $request->get('year', date('Y'));
    $roomId = $request->get('roomid');
    $currentMonth = (int) date('m');
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
      )->when(
        Str::of($roomId)->trim()->isNotEmpty(),
        function ($builder) use ($roomId) {
          return $builder->where('room_id', $roomId);
        }
      )
      ->whereYear('started_at', $year)
      ->get();

    return Response::payload($schedules);
  }


  public function store(Request $request)
  {
    $request->validate([
      'schedule' => 'required|numeric',
      'employee' => 'required|numeric'
    ]);


    $schedule = Schedule::findOrFail($request->schedule);

    abort_if(
      $schedule->started_at
        ->greaterThanOrEqualTo(
            now()
        ),
        401
    );

    
    $participant = Participant::create([
      'schedule_id' => $schedule->id,
      'employee_id' => $request->employee
    ]);

    return response()
      ->json([
        'status' => true,
        'data' => compact('participant')
      ], 200);
  }
}
