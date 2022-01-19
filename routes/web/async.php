<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Async\RegisteredParticipantController;
use App\Http\Controllers\Web\Async\SchedulesController;
use App\Http\Controllers\Web\Async\AttachmentsController;
use App\Http\Controllers\Web\Async\ScheduleReviewController;


Route::group(['middleware' =>  'auth'], function () {

  Route::get('/schedules/{schedule}', [SchedulesController::class, 'show'])
    ->name('async.schedules.show');

  Route::post('/schedules', [SchedulesController::class, 'store'])
    ->name('async.schedules.store');

  Route::put('/schedules/{schedule}', [SchedulesController::class, 'update'])
    ->name('async.schedules.update');

  Route::resource('attachments', AttachmentsController::class)
    ->only(['store', 'destroy'])
    ->parameters([
      'attachments' => 'id'
    ]);

  Route::put('/schedule/{schedule}/review', [ScheduleReviewController::class, 'update']);
});

Route::post('participants/new', [RegisteredParticipantController::class, 'store'])
  ->name('async.participants.new');


