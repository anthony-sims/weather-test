<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'authenticate']);
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/weather', WeatherController::class);

Route::middleware('auth:sanctum')->controller(UserController::class)->group(function () {
    Route::get('/users/{user}', 'show');
    Route::post('/users', 'store');
});

Route::middleware('auth:sanctum')->controller(PostController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::get('/posts/{post}', 'show');
    Route::post('/posts', 'store');
    Route::patch('/posts/{post}', 'update');
    Route::delete('/posts/{post}', 'destroy');
});