<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Response;

use App\Models\Room;

class RoomsController extends Controller
{
  public function index()
  {
    $rooms = Room::all();

    return Response::payload($rooms);
  }

  public function show(Request $request, Room $room)
  {

    $schedules = $room->schedules()
      ->with(['user:id,name,phone_number'])
      ->confirm()
      ->where(function (Builder $builder) use ($request) {
        if ($request->filled('day')) {
          $builder->whereDay('started_at', $request->get('day'));
        }

        if ($request->filled('month')) {
          $builder->whereMonth('started_at', $request->get('month'));
        }

        if ($request->filled('year')) {
          $builder->whereYear('started_at', $request->get('year'));
        }

        return $builder;
      })
        ->get();

    return Response::payload($schedules);
  }

  
}
