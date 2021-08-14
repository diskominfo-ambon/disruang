<?php

namespace App\Http\Controllers\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\ScheduleRegisteredParticipantExport;
use App\Models\Schedule;

class ScheduleRegisteredParticipantController extends Controller
{
  public function index(Schedule $schedule)
  {
    $fileName = now()->year. '-'.now()->month.'_'.$schedule->title.'.xlsx';

    return Excel::download(
      new ScheduleRegisteredParticipantExport($schedule),
      $fileName
    );
  }
}
