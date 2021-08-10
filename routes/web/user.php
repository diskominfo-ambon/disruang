<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\User\HomeController;
use App\Http\Controllers\Web\User\SchedulesController;
use App\Http\Controllers\Web\User\SubmissionsController;
use App\Models\Schedule;

Route::get('/', [HomeController::class, 'index'])
  ->name('user.home');

Route::get('/submissions', [SubmissionsController::class, 'index'])
  ->name('user.submissions');

Route::delete('/submissions/{schedule}', [SubmissionsController::class, 'destory'])
  ->name('user.submissions.destroy');

Route::view('/schedules/new', 'web::user.schedules.new')
  ->name('user.schedules.new');

Route::post('/schedules/new', [SchedulesController::class, 'store'])
  ->name('user.schedules.store');

Route::get('/schedules/read/{schedule}', [SchedulesController::class, 'show'])
  ->name('user.schedules.show')
  ->missing(function () {
    return redirect()->route('user.home');
});
