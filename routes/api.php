<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/user', 'App\Http\Controllers\Auth\UserController@show');
//     Route::put('/user', 'App\Http\Controllers\Auth\UserController@update');
//     Route::delete('/user', 'App\Http\Controllers\Auth\UserController@destroy');
//     Route::post('/user/change-password', 'App\Http\Controllers\Auth\UserController@changePassword');
//     Route::get('/user/{id}', 'App\Http\Controllers\Auth\UserController@getUserById');
//     Route::get('/users', 'App\Http\Controllers\Auth\UserController@getAllUsers');
// });

Route::post('/register', [RegisterController::class, 'registerUser']);

Route::post('/login', [UserController::class, 'getUserByEmailAndPassword']);
