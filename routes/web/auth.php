<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use App\Http\Controllers\Web\Auth\RegistredUserController;


Route::group(['middleware' => 'auth'], function () {
  Route::post('/logout', [LogoutController::class, 'store'])
    ->name('auth.logout.store');
});


Route::group(['middleware' => 'guest'], function () {
  Route::view('/login', 'auth::login')
    ->name('auth.login');

  Route::post('/login', [LoginController::class, 'store'])
    ->name('auth.login.store');

  Route::view('/register', 'auth::register')
    ->name('auth.register');

  Route::post('/register', [RegistredUserController::class, 'store'])
    ->name('auth.register.store');
});
