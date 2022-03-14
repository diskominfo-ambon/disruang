<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleInvitationController extends Controller
{
    public function __invoke($schedule, $id)
    {
        $origins = $schedule->origins;
        $employees = collect([]);

        foreach ($origins as $origin) {
            $employees->push(...$origin->employees);    
        }

        if ($employees->count() > 0) {
            $employee = $employees->filter(fn ($employee) => $employee->id == $id)->first();
        } else {

            $employee = $schedule->employees()
                ->where('employees.id', $id)
                ->first();
          
        }

        abort_if(
            is_null($schedule)
            || is_null($employee),
            404
        );

        return view('vendor.print.schedule-invitation', compact('schedule', 'employee'));
    }
}
