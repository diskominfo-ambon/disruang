<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Web\Exports\RegisteredScheduleController;
use App\Http\Controllers\Web\User\ScheduleInvitationController;


Route::inertia('/', 'welcome')->name('welcome');

Route::group(['middleware' => 'auth'], function () {

  Route::get('/exports/schedules/participants/{schedule:id}', [RegisteredScheduleController::class, 'index'])
    ->name('exports.schedules.participants');

});


Route::get('/undangan/{schedule:slug}/{id}', ScheduleInvitationController::class)
  ->name('schedule-invitation');