<?php

use App\Http\Controllers\GetController;
use App\Http\Controllers\Image\ImageController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'sanctum'], function() {
    Route::get('/get', GetController::class, '__invoke');
});


Route::group(['namespace' => 'Person', 'prefix' => 'people'], function() {
    Route::get('/', [PersonController::class, 'index']);
    Route::post('/', [PersonController::class, 'store']);
    Route::get('/{person}', [PersonController::class, 'show']);
    Route::patch('/{person}', [PersonController::class, 'update']);
    Route::delete('/{person}', [PersonController::class, 'delete']);
});

Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function() {
    Route::group(['prefix' => 'images', 'namespace' => 'Image'], function() {
        Route::post('/', [ImageController::class, 'store']);
    });
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{post}', [PostController::class, 'edit']);
    Route::post('/', [PostController::class, 'store']);
    Route::patch('/{post}', [PostController::class, 'update']);
});
