<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Models\Schedule;

class RegisteredScheduleExport implements FromView
{


  public function __construct(private Schedule $schedule)
  {

  }

  public function view(): View
  {
    // load relation participants.
    $this->schedule->load('participants');

    return view('exports.schedules.participants', [
      'schedule' => $this->schedule
    ]);
  }
}
