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

        $body = $request->all();

        if ($schedule->isReview) {
            $body = $request->merge([
                'status' => Schedule::$CONFIRM
            ])->all();
            
        }

        $schedule->employees()->sync($employees);

        
        $schedule->update($body);

        SendBulkEmailInvitation::dispatch($schedule);

        if ($request->filled('attachments')) {

            $schedule->attachments()->sync($request->attachments);
        }

        return Response::success(
            message: 'Berhasil menijau kegiatan "'. $schedule->title . '"'
        );
    }
}
