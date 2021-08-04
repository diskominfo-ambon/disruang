<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\web\user\HomeController;
use App\Http\Controllers\web\user\SchedulesController;
use App\Http\Controllers\web\user\SubmissionsController;

Route::get('/', [HomeController::class, 'index'])
  ->name('user.home');

Route::get('/submissions', [SubmissionsController::class, 'index'])
  ->name('user.submissions');

Route::delete('/submissions/{schedule}', [SubmissionsController::class, 'destory'])
  ->name('user.submissions.destroy');

Route::view('/schedules/new', 'web::pages.user.schedules.new')
  ->name('user.schedules.new');

Route::post('/schedules/new', [SchedulesController::class, 'store'])
  ->name('user.schedules.store');

Route::get('/schedules/{schedule:slug}', [SchedulesController::class. 'show'])
  ->name('user.schedules.show');

