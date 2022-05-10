<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Jobs\SendEmailInvitation;
use App\Http\Controllers\Controller;
use App\Jobs\SendBulkEmailInvitation;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ScheduleReviewRequest;

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

    public function index(Schedule $schedule)
    {
        return view('web.admin.schedules.review', compact('schedule'));
    }
}
