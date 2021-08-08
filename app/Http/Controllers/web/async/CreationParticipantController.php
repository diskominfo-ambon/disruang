<?php

namespace App\Http\Controllers\web\async;

use App\Http\Controllers\Controller;

use App\Http\Requests\ParticipantRequest;
use App\Models\Participant;
use Illuminate\Support\Facades\Response;

class CreationParticipantController extends Controller
{
  public function store(ParticipantRequest $request)
  {
    $participant = Participant::create(
      $request->all()
    );

    return Response::success(
      message: "Selamat {$participant->name}, Berhasil mendaftar pada kegiatan",
      code: 201
    );
  }
}
