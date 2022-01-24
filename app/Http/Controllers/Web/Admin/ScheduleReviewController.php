<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Schedule;
use App\Http\Requests\ScheduleReviewRequest;

class ScheduleReviewController extends Controller
{
    public function update(ScheduleReviewRequest $request, Schedule $schedule)
    {

        $schedule->update(
            $request->all()
        );
        $schedule->employees()->sync($request->employees);

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
