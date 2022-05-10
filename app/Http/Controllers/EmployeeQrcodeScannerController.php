<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Origin;
use App\Models\Participant;
use Illuminate\Http\Request;

class EmployeeQrcodeScannerController extends Controller
{
    public function __invoke(Request $request) {
        $schedule = $request->schedule;
        $id = $request->id;

        $employee = Employee::findOrFail($id);

        if (
            $schedule
                ->employees()
                ->find($employee->id)
            ||  $schedule
                    ->origins()
                    ->findOrFail($employee->origin->id)
            && Participant::where('employee_id', $employee->id)
                ?->first()
                ->isNotPresent
        ) {

            Participant::insert([
                'is_present' => true,
                'schedule_id' => $schedule->id,
                'employee_id' => $employee->id
            ]);
        }

        return view('web.qrcode.success', compact('schedule'));

    }
}
