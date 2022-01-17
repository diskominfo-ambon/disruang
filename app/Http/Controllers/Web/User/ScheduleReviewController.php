<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleReviewController extends Controller
{
    public function index(Schedule $schedule)
    {
       
        return view('web.user.schedules.review', compact('schedule'));
    }
}
