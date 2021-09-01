<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;

class SchedulesController extends Controller
{
  public function edit(Schedule $schedule)
  {
    if (!$schedule->isPending) {
      return Redirect::back()
        ->with(
          'message',
          'Kegiatan tidak tersedia'
        );
    }

    return view('web::user.schedules.edit', compact('schedule'));
  }

  public function destroy(Schedule $schedule)
  {
    // schedule status has confirm.
    if ($schedule->status === 'confirm') {
      return redirect()
        ->back();
    }

    $schedule->delete();

    return redirect()
      ->back()
      ->with(
        'message',
        'Berhasil menghapus permohonan kegiatan'
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
