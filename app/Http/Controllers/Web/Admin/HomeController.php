<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Schedule;
use App\Models\User;

class HomeController extends Controller
{
  public function index()
  {
    $superUsersCount = User::role('admin')->count();
    $usersCount = User::role('user')->count();
    $schedules = Schedule::confirm();

    // schedule in days.
    $scheduleInDays = $schedules->limit(20)
      ->get()
      ->filter(fn ($schedule) => $schedule->started_at->isToday());


    // schedule in weeks.
    $scheduleInWeeks = $schedules->limit(20)
      ->get()
      ->filter(function ($schedule) {
        $current = now();

        return $schedule->started_at >= $current->startOfWeek()
          && $schedule->started_at <= $current->endOfWeek();
    });

    $schedule = (object) [
      'weeks' => $scheduleInWeeks,
      'days' => $scheduleInDays,
      'all' => $schedules
    ];

    return view('web::admin.home', compact('superUsersCount', 'usersCount', 'schedule'));
  }
}
