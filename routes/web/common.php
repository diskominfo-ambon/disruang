<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Exports\ScheduleRegisteredParticipantController;

Route::inertia('/', 'welcome')->name('welcome');

Route::group(['middleware' => 'auth'], function () {

  Route::get('/exports/schedules/participants/{schedule:id}', [ScheduleRegisteredParticipantController::class, 'index'])
    ->name('exports.schedules.participants');

});
