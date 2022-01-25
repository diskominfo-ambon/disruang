<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Schedule;
use App\Models\Room;
use App\Http\Requests\ScheduleRequest;
use Illuminate\Database\Eloquent\Builder;

class SchedulesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $rooms = Room::all();
    $schedules = Schedule::confirm()
      ->orWhrere('status', Schedule::$REVIEW)
      ->where(function (Builder $builder) use ($request) {
        if ($request->filled('date')) {
          $date = carbon($request->get('date')); // parse date in carbon instance.
          $builder->whereDate('started_at', $date);
        }

        if ($request->filled('room') && $request->get('room') !== '*') {
          $builder->where('room_id', $request->get('room'));
        }

        if ($request->filled('keyword')) {
          $builder->where('title', 'like', "%{$request->get('keyword')}%");
        }
      })
      ->paginate(20);

    $schedules->append(['keyword', 'room', 'date']);

    return view('web::admin.schedules.index', compact('schedules', 'rooms'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('web::admin.schedules.new');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ScheduleRequest $request)
  {
    if (Gate::check('schedule.must.unique', $request)) {
      return Response::failed(
        code: 403,
        message: 'Keliatanya waktu telah digunakan/booking oleh kegiatan lain.'
      );
    }

    $schedule = Auth::user()->schedules()->create(
      array_merge($request->all(), ['status' => Schedule::$CONFIRM])
    );


    return Response::success(
      message: 'Berhasil menambahkan kegiatan ' . str($schedule->title)->limit(20),
      route: route('admin.schedules.index')
    );
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Schedule  $schedule
   * @return \Illuminate\Http\Response
   */
  public function edit(Schedule $schedule)
  {
    return view('web::admin.schedules.edit');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Schedule  $schedule
   * @return \Illuminate\Http\Response
   */
  public function update(ScheduleRequest $request, Schedule $schedule)
  {
    // not implements.
  }


  public function show(Request $request, Schedule $schedule)
  {
    $participants = $schedule->participants()->paginate(20);

    // keyword search by participant name.
    $keyword = $request->get('keyword', '');

    if (
      Str::of($keyword)->trim()
      ->isNotEmpty()
    ) {

      $participants = $schedule->participants()
        ->where('name', 'like', "%{$keyword}%")
        ->paginate(20)
        ->appends('keyword');
    }


    return view('web::admin.schedules.show', compact('schedule', 'participants'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Schedule  $schedule
   * @return \Illuminate\Http\Response
   */
  public function destroy(Schedule $schedule)
  {
    abort_if(!auth()->user()->can('kominfo'), 401);

    $schedule->delete();

    return Redirect::route('admin.schedules.index')
      ->with(
        'message',
        'Berhasil menghapus kegiatan'
      );
  }
}
