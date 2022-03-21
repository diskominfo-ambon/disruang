<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;

class ScheduleParticipantInvitationController extends Controller
{
    public function __invoke($schedule, $id) {
        $participant = Participant::findOrFail($id);
        

        abort_if(
            $participant->schedule_id !== $schedule->id,
            404
        );

        return view('vendor.print.schedule-participant-invitation', compact('schedule', 'participant'));
    }
}
