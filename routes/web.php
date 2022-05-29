<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auth', [AuthController::class, 'index'])->name('auth_page');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
