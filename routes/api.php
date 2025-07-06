<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Route::post('/register', [RegisterController::class, 'registerUser']);
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::delete('/users/{id}', [UserController::class, 'deleteUserById']);
Route::get('/users/{id}', [UserController::class, 'getUserById']);
Route::put('/users/{id}', [UserController::class, 'updateUserById']);

Route::post('register', [RegisteredUserController::class, 'register']);

Route::post('login', [AuthenticatedSessionController::class, 'loginApi'])
        ->name('login');

   //Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'logoutApi'])
        ->name('logout');

Route::get('products/search', [ProductController::class, 'search']);

Route::get('products', [ProductController::class, 'index'])
        ->name('products.index');

Route::get('sessions/{id}', [AuthenticatedSessionController::class, 'sessionApi'])
        ->name('sessions.show');



Route::middleware('auth')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');
        
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    //     ->name('logout');
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/category', [ProductController::class, 'getCategories']);
Route::get('/products/brand', [ProductController::class, 'getBrands']);
Route::patch('/products', [ProductController::class, 'batch']);
