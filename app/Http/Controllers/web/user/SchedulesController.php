<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;

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


  public function show(Request $request, Schedule $schedule)
  {

    // eager load relationship participants.
    $schedule->load(['user']);

    $participants = $schedule->participants()
      ->paginate(12)
      ->appends('keyword');
    // keyword search by participant name.
    $keyword = $request->get('keyword', '');

    if (
      Str::of($keyword)->trim()
        ->isNotEmpty()
    ) {

      $participants = $schedule->participants()
        ->where('name', 'like', "%{$keyword}%")
        ->paginate(12)
        ->appends('keyword');
    }


    return view('web::user.schedules.show', compact('schedule', 'participants', 'keyword'));
  }
}
