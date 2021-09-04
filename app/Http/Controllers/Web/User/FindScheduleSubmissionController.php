<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;

class FindScheduleSubmissionController extends Controller
{
  public function index(Request $request)
  {
    $order = $request->get('order', 'pending');

    if (!in_array($order, ['pending', 'confirm', 'reject'])) {
      $order = 'pending';
    }

    $schedules = Auth::user()
      ->schedules()
      ->with('notifications')
      ->order($order)
      ->get();

    return view('web::user.dashboards.submission', compact('schedules', 'order'));
  }

}
