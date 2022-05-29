<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\SimpleAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth', [AuthController::class, 'index'])->name('auth_page');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::get('/dashboard', function () {
    return response(200);
})
    ->name('dashboard')
    ->middleware(SimpleAuth::class);
