<?php

namespace App\Http\Controllers\Web\Async;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;

class SchedulesController extends Controller
{

  public function __construct()
  {
    $this->middleware(function (Request $request, $next) {

      if (in_array($request->getMethod(), ['POST', 'PUT'])) {
        $request->merge([
          'started_at' =>
            carbon($request?->started_at)
              ->format('Y-m-d H:i:s'),

          'ended_at' =>
            carbon($request?->ended_at)
              ->format('Y-m-d H:i:s')
        ]);
      }

      return $next($request);
    });
  }



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
        $request->except('range')
      );

    return Response::success(
      message: 'Berhasil menambahkan kegiatan!',
      route: route('user.submissions')
    );
  }



  public function update(ScheduleRequest $request, Schedule $schedule)
  {
    if (Gate::check('schedule.must.unique', $request)) {
      return Response::failed(
        code: 403,
        message: 'Keliatanya waktu telah digunakan/booking oleh kegiatan lain.'
      );
    }

    if (Auth::user()->id !== $schedule->user_id) {
      return Response::failed(403);
    }

    // update schedule to db.
    $schedule->update(
      $request->except('range')
    );

    return Response::success(
      message: 'Berhasil merubah kegiatan!',
      route: route('user.home')
    );
  }
}
