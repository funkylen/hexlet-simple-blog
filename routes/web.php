<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\SimpleAuth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts')->name('home');

Route::get('/auth', [AuthController::class, 'index'])->name('auth_page');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::resource('posts', PostController::class);
