<?php

namespace App\Http\Controllers\Web\Async;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ParticipantRequest;
use App\Models\Participant;
use App\Models\Schedule;
use Illuminate\Support\Facades\Redirect;
use App\Jobs\SendEmailInvitation;

class RegisteredParticipantController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'schedule' => 'required|numeric',
      'name' => 'required',
      'phone' => 'required',
      'email' => 'required',
      'gender' => 'required'
    ], [], [
      'name' => 'Nama',
      'phone' => 'Nomor telepon',
      'email' => 'Alamat email',
      'origin' =>  'Nama tokoh',
      'gender' => 'Jenis kelamin'
    ]);

     $request->merge([
      'schedule_id' => $request->schedule,
      'origin' => $request->origin,
      'phone_number' => $request->phone
    ]);

    $participant = Participant::where('email', $request->email)
      ->where('schedule_id', $request->schedule);

    if ($participant->count() > 0) {
      return Redirect::back()
        ->withInput()
        ->with('message', 'Alamat email sudah digunakan untuk kegiatan ini');
    }
    $schedule = Schedule::withoutGlobalScopes()->findOrFail($request->schedule);
    $currentParticipant = Participant::create($request->all());

    SendEmailInvitation::dispatch($schedule, $currentParticipant);

    return Redirect::back()
      ->with(
        'message',
        "Terima kasih pendaftaran berhasil, silahkan cek email kamu untuk lihat undangan"
      );
  }
}
