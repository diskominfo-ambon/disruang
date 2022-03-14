<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Schedule;
use App\Models\Room;

class HomeController extends Controller
{
  public function index(Request $request)
  {
    $rooms = Room::all();
    $room = $rooms->first();
    $roomId = $request->get('room', $room->id);
    
    $schedules = Schedule::order(Schedule::$CONFIRM)                                                                                                                                                                                                                                        
      ->with(['participants', 'room'])
      ->whereHas('room', fn ($query) => $query->whereId($roomId))
      ->latest()
      ->paginate(20);

    return view('web::user.dashboards.home', compact('schedules', 'rooms', 'roomId'));
  }
}
