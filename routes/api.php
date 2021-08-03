<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RoomsController;
use App\Http\Controllers\Api\SchedulesController;

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


Route::get('/rooms', [RoomsController::class, 'index'])
  ->name('api.rooms');


Route::post('/schedules', [SchedulesController::class, 'store'])
  ->name('api.schedules.store');

Route::put('/schedules', [SchedulesController::class, 'update'])
  ->name('api.schedules.update');
