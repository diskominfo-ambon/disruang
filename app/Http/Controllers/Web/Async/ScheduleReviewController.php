<?php

namespace App\Http\Controllers\Web\Async;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ScheduleReviewRequest;
use App\Jobs\SendBulkEmailInvitation;
use App\Models\Schedule;
use App\Models\Origin;

class ScheduleReviewController extends Controller
{
    public function update(ScheduleReviewRequest $request, Schedule $schedule)
    {
        $employeesId = $request->employees;
        $originsId = $request->origins;
        $body = $request->all();       
        $employees = collect([]);
        
        $schedule->origins()->sync($originsId);
        $schedule->employees()->sync($employeesId);
        
        $schedule->update($body);
        
        $origins = $schedule->origins;
        $origins->load('employees');
        
        foreach($origins as $origin) {
            $employees->push(
                ...$origin->employees
            );
        }

        if ($request->post('asn_available')) {
            $employees = $employees->merge($schedule->employees);
        }

   
        SendBulkEmailInvitation::dispatch($schedule, $employees);

        if ($request->filled('attachments')) {

            $schedule->attachments()->sync($request->attachments);
        }

        return Response::success(
            message: 'Berhasil menijau kegiatan "'. $schedule->title . '"'
        );
    }
}
