<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LogoutController;
use App\Http\Controllers\Web\Auth\UserRegistrationController;


Route::view('/login', 'web::pages/auth/login')
  ->name('auth.login');

Route::post('/login', [LoginController::class, 'store'])
  ->name('auth.login.store');

Route::post('/logout', [LogoutController::class, 'store'])
  ->name('auth.logout.store');

Route::view('/register', 'web::pages/auth/register')
  ->name('auth.register');

Route::post('/register', [UserRegistrationController::class, 'store'])
  ->name('auth.register.store');
