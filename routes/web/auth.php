<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use App\Http\Controllers\Web\Auth\RegisteredUserController;
use App\Http\Controllers\Web\Auth\RegisteredEmployeeController;


Route::group(['middleware' => 'auth'], function () {
  Route::post('/logout', [LogoutController::class, 'store'])
    ->name('auth.logout.store');
});


Route::group(['middleware' => 'guest'], function () {
  Route::view('/login', 'auth::login')
    ->name('auth.login');

  Route::post('/login', [LoginController::class, 'store'])
    ->name('auth.login.store');

  Route::get('/register', [RegisteredUserController::class, 'index'])
    ->name('auth.register');

  Route::post('/employee/register', [RegisteredEmployeeController::class, 'store'])
    ->name('auth.employee.register.store');

  Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('auth.register.store');
});
