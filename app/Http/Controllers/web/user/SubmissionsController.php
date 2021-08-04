<?php

namespace App\Http\Controllers\web\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Schedule;

class SubmissionsController extends Controller
{
  public function index(Request $request)
  {
    $order = $request->get('order', 'pending');

    if (!in_array($order, ['pending', 'confirm', 'reject'])) {
      $order = 'pending';
    }

    $schedules = Auth::user()
      ->schedules()
      ->order($order)
      ->get();


    return view('web::pages.user.dashboards.submission', compact('schedules', 'order'));

  }


  public function destroy(Schedule $schedule)
  {
    // schedule status has confirm.
    if ($schedule->status === 'confirm') {
      return redirect()
        ->back();
    }

    $schedule->delete();

    return redirect()
      ->back()
      ->with(
        'message',
        'Berhasil menghapus permohonan kegiatan'
      );
  }
}
