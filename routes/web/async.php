<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Async\RegisteredParticipantController;
use App\Http\Controllers\Web\Async\SchedulesController;


Route::group(['middleware' =>  'auth'], function () {

  Route::post('/schedules', [SchedulesController::class, 'store'])
    ->name('async.schedules.store');

  Route::put('/schedules', [SchedulesController::class, 'update'])
    ->name('async.schedules.update');
});

Route::post('participants/new', [RegisteredParticipantController::class, 'store'])
  ->name('async.participants.new');
