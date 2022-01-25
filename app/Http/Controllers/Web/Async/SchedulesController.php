<?php

namespace App\Http\Controllers\Web\Async;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Models\Employee;

class SchedulesController extends Controller
{

  public function store(ScheduleRequest $request)
  {
    if (Gate::check('schedule.must.unique', $request)) {
      return Response::failed(
        code: 403,
        message: 'Keliatanya waktu telah digunakan/booking oleh kegiatan lain.'
      );
    }

    Auth::user()->schedules()
      ->create(
        $request->all()
      );


    return Response::success(
      message: 'Berhasil menambahkan kegiatan!',
      route: route('user.submissions')
    );
  }


  public function show(Schedule $schedule)
  {
    $schedule->load(['employees', 'attachments']);
    
    return Response::payload($schedule);
  }



  public function update(ScheduleRequest $request, Schedule $schedule)
  {

    if (Auth::user()->id != $schedule->user_id) {
      return Response::failed(403);
    }

    if (Auth::user()->hasRole('user') && !$schedule->isPending) {
      return Response::failed(
        code: 403,
        message: 'Kegiatan telah ditinjau, untuk saat ini tidak dapat dirubah',
      );
    }

    if (Gate::check('schedule.must.unique', $request->merge(['schedule_id' => $schedule->id])) ) {
      return Response::failed(
        code: 403,
        message: 'Keliatanya waktu telah digunakan/booking oleh kegiatan lain.'
      );
    }


    // update schedule to db.
    $schedule->update(
      $request->except('range')
    );

    return Response::success(
      message: 'Berhasil menyimpan perubahan kegiatan!',
      route: route('user.submissions')
    );
  }
}
