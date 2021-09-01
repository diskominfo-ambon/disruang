<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Schedule;
use Illuminate\Support\Facades\Schema;

class SubmissionsController extends Controller
{
  public function index(Request $request)
  {
    $order = $request->get('order', Schedule::PENDING);

    if (!in_array($order, [Schedule::PENDING, Schedule::REJECT])) {
      $order = Schedule::PENDING;
    }

    $schedules = Schedule::order($order)->get();

    return view('web::admin.submission', compact('schedules', 'order'));
  }

  public function update(Request $request, Schedule $schedule)
  {
    $status = $request->get('order') === Schedule::CONFIRM
    ? Schedule::CONFIRM
    : Schedule::REJECT;


    $schedule->update(compact('status'));

    return Redirect::back()
      ->with(
        'message',
        'Berhasil melakukan peninjauan kegiatan'
      );
  }
}
