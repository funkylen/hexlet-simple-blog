<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\SimpleAuth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts')->name('home');

Route::get('/auth', [AuthController::class, 'index'])->name('auth_page');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::view('/posts/create', 'post.create')
    ->name('create_post_page')
    ->middleware(SimpleAuth::class);

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts_page');

Route::post('/posts', [PostController::class, 'store'])
    ->name('create_post')
    ->middleware(SimpleAuth::class);

Route::get('/posts/{id}', [PostController::class, 'show'])
    ->name('show_post_page');

Route::get('/posts/{id}/edit', [PostController::class, 'edit'])
    ->name('edit_post_page')
    ->middleware(SimpleAuth::class);

Route::post('/posts/{id}', [PostController::class, 'update'])
    ->name('update_post')
    ->middleware(SimpleAuth::class);

Route::delete('/posts/{id}', [PostController::class, 'delete'])
    ->name('delete_post')
    ->middleware(SimpleAuth::class);
