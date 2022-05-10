<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QrcodeScannerController extends Controller
{
    public function __invoke(Request $request, $schedule, $id)
    {

        $participant = Participant::findOrFail($id);

        if (
            $participant->schedule_id == $schedule->id
        ) {
            $participant->update([
                'is_present' => true,
            ]);


        }else {
            return abort(404);
        }

        return view('web.qrcode.success', compact('schedule'));
    }
}
