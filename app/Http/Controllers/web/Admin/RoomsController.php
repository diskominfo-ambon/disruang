<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

use App\Models\Room;

class RoomsController extends Controller
{

    public function __construct()
    {
      abort_if(Gate::allows(['humas', 'protocol']), 401);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $keyword = $request->get('keyword', '');
      $rooms = Room::where('name', 'like', "%{$keyword}%")
        ->paginate(20);

      $rooms->append('keyword');

      return view('web::admin.rooms.index', compact('rooms', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('web::admin.rooms.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $body = $request->validate([
        'name' => 'required'
      ], [], [
        'name' => 'Nama ruangan'
      ]);

      $room = Room::create(
        $body
      );

      return Redirect::route('admin.rooms.index')
        ->with(
          'message',
          "Berhasil menambahkan ruangan {$room->name}"
        );
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
      return view('web::admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
      $body = $request->validate([
        'name' => 'required'
      ], [
        'name' => 'Nama ruangan'
      ]);

      $room->update(
        $body
      );

      return Redirect::route('admin.rooms.index')
        ->with(
          'message',
          "Berhasil menyimpan perubahan ruangan {$room->name}"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
      $message = "Berhasil menghapus ruangan {$room->name}";
      // delete room in db.
      $room->delete();

      return Redirect::back()
        ->with(
          'message',
          $message
        );
    }
}
