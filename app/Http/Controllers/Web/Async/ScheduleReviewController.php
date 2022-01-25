<?php

namespace App\Http\Controllers\Web\Async;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Schedule;
use App\Http\Requests\ScheduleReviewRequest;
use App\Jobs\SendBulkEmailInvitation;

class ScheduleReviewController extends Controller
{
    public function update(ScheduleReviewRequest $request, Schedule $schedule)
    {
        $employees = $request->employees;


        if ($schedule->isReview()) {
            $request->merge([
                'status' => Schedule::$CONFIRM
            ]);

            SendBulkEmailInvitation::dispatch($employees);
        }
        $schedule->update(
            $request->all()
        );
        $schedule->employees()->sync();

        if ($request->filled('attachments')) {

            $schedule->attachments()->sync($request->attachments);
        }

        return Response::success(
            message: 'Berhasil menijau kegiatan "'. $schedule->title . '"'
        );
    }
}
