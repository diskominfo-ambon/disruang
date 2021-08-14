<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\User\HomeController;
use App\Http\Controllers\Web\User\SchedulesController;
use App\Http\Controllers\Web\User\FindScheduleSubmissionController;


Route::get('/', [HomeController::class, 'index'])
  ->name('user.home');

Route::get('/submissions', [FindScheduleSubmissionController::class, 'index'])
  ->name('user.submissions');

Route::get('/schedules/edit/{schedule}', [SchedulesController::class, 'edit'])
  ->name('user.schedules.edit');

Route::delete('/schedules/delete/{schedule}', [SchedulesController::class, 'destroy'])
  ->name('user.schedules.destroy');

Route::view('/schedules/new', 'web::user.schedules.new')
  ->name('user.schedules.new');

Route::get('/schedules/read/{schedule}', [SchedulesController::class, 'show'])
  ->name('user.schedules.show')
  ->missing(function () {
    return redirect()->route('user.home');
});
