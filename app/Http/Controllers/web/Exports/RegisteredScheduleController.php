<?php

namespace App\Http\Controllers\Web\Exports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\RegisteredScheduleExport;
use App\Models\Schedule;

class RegisteredScheduleController extends Controller
{
  public function index(Schedule $schedule)
  {
    $fileName = now()->year. '-'.now()->month.'_'.$schedule->title.'.xlsx';

    return Excel::download(
      new RegisteredScheduleExport($schedule),
      $fileName
    );
  }
}
