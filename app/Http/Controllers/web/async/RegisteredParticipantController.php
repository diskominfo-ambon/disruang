<?php

namespace App\Http\Controllers\Web\Async;

use App\Http\Controllers\Controller;

use App\Http\Requests\ParticipantRequest;
use App\Models\Participant;
use Illuminate\Support\Facades\Redirect;

class RegisteredParticipantController extends Controller
{
  public function store(ParticipantRequest $request)
  {

    $signature = $request->file('signatureFile')->store('signature', 'public');

    $request->merge([
      'signature' => $signature,
    ]);

    $participant = Participant::create(
      $request->except(['asn', 'signatureFile', 'phoneNumber'])
    );

    return Redirect::back()
      ->with(
        'message',
        "Semoga kegiatan yang ikuti dapat bermanfaat bagi kamu {$participant->name} dan teman-teman."
      );
  }
}
