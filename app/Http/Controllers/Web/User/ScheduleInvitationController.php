<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleInvitationController extends Controller
{
    public function __invoke($schedule, $id)
    {
    
        $employee = $schedule->employees()
            ->where('employees.id', $id)
            ->first();

       
        abort_if(
            is_null($schedule) || is_null($employee),
            404
        );

        return view('vendor.print.schedule-invitation', compact('schedule', 'employee'));
    }
}
