<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;

use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;

class SchedulesController extends Controller
{
  public function store(ScheduleRequest $request)
  {
    Schedule::create(
      $request->all()
    );

    return redirect()
      ->route('user.submission')
      ->with(
        'message',
        'Berhasil, permohonan kegiatan kamu masih tahap pending.'
      );
  }


  public function show(Schedule $schedule)
  {
    dd($schedule);
  }
}
