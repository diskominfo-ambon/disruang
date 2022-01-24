<?php

namespace App\Http\Controllers\Web\Async;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Schedule;
use App\Https\Requests\ScheduleReviewRequest;


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
}
