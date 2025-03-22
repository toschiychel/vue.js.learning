<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PersonController;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Support\Facades\Route;

// Route::get('/{page}', [IndexController::class, '__invoke']);
Route::get('/{page}', [IndexController::class, '__invoke'])->where('page', '.*');

Auth::routes();
Route::view('/vue', 'vue')->middleware(HandleCors::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

