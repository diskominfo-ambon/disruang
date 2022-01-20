<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Admin\HomeController;
use App\Http\Controllers\Web\Admin\SuperUsersController;
use App\Http\Controllers\Web\Admin\SchedulesController;
use App\Http\Controllers\Web\Admin\UsersController;
use App\Http\Controllers\Web\Admin\SubmissionsController;
use App\Http\Controllers\Web\Admin\RoomsController;
use App\Http\Controllers\Web\Admin\ScheduleReviewController;


Route::get('/', [HomeController::class, 'index'])
  ->name('admin.home');

Route::get('/submissions', [SubmissionsController::class, 'index'])
  ->name('admin.submissions');

Route::put('/submissions/{schedule}', [SubmissionsController::class, 'update'])
  ->name('admin.submissions.update');

Route::resource('schedules', SchedulesController::class, ['as' => 'admin']);

Route::put('/schedules/{schedule}/review', [ScheduleReviewController::class, 'update'])
  ->name('admin.schedules.review.update');

Route::get('/schedules/{schedule}/review', [ScheduleReviewController::class, 'index'])
  ->name('admin.schedules.review');

Route::resource('d', SuperUsersController::class, ['as' => 'admin'])
  ->except('show')
  ->middleware('permission:kominfo')
  ->parameters([
    'd' => 'user'
  ]);

Route::resource('rooms', RoomsController::class, ['as' => 'admin'])
  ->middleware('permission:kominfo')
  ->except('show');

Route::resources([
  'users' => UsersController::class,
], [
  'as' => 'admin',
  'except' => ['show']
]);
