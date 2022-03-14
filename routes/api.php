<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RoomsController;
use App\Http\Controllers\Api\SchedulesController;
use App\Http\Controllers\Api\EmployeesController;
use App\Http\Controllers\Api\OriginsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/schedules', [SchedulesController::class, 'index'])
  ->name('api.schedules');


Route::post('/schedules', [SchedulesController::class, 'store'])
  ->name('api.schedules.store');

Route::get('/rooms', [RoomsController::class, 'index'])
  ->name('api.rooms');

Route::get('/rooms/{room:id}', [RoomsController::class, 'show'])
  ->name('api.rooms.show');

Route::get('/employees', [EmployeesController::class, 'index']);

Route::get('/origins', [OriginsController::class, 'index']);


Route::get('/schedule', [EmployeesController::class, 'index']);