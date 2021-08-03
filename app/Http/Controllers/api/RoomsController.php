<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;
use Illuminate\Support\Facades\Response;

class RoomsController extends Controller
{
  public function index()
  {
    $rooms = Room::all();

    return Response::payload($rooms);
  }
}
