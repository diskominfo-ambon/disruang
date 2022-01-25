<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

use App\Models\Schedule;
use App\Notifications\ScheduleConfirmed;
use App\Notifications\ScheduleRejected;

class SubmissionsController extends Controller
{
  public function index(Request $request)
  {
    $order = $request->get('order', Schedule::$PENDING);

    if (!in_array($order, [Schedule::$PENDING, Schedule::$REJECT])) {
        $order = Schedule::$PENDING;
    }

    if ($order === Schedule::$REJECT) {
        Session::flash('rejected_on_view', true);
    }

    $schedules = Schedule::order($order)->get();

    return view('web::admin.submission', compact('schedules', 'order'));
  }

  public function update(Request $request, Schedule $schedule)
  {
    $order = $request->get('order');
    // message used for rejection notification.
    $message = $request->post('message', '');

    $status = $order === Schedule::$REVIEW
      ? Schedule::$REVIEW
      : Schedule::$REJECT;


    // sending notification from reviewed schedule.
    Notification::send(
      $schedule, $status === Schedule::$REVIEW
        ? new ScheduleConfirmed()
        : new ScheduleRejected($message)
    );

    $schedule->update(compact('status'));

    return Redirect::back()
      ->with(
      'message',
      'Berhasil melakukan peninjauan kegiatan'
      );
  }
}
