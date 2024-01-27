<?php

use App\Http\Middleware\TokenMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// auth api route
Route::post('/user-registration',[UserController::class,'userRegistration'])->name('user-registration');
Route::post('/user-login',[UserController::class,'userLogin'])->name('user-login');

Route::get('/user-logout',[UserController::class,'UserLogout'])->name('user-logout');

Route::post('/user-send-otp',[UserController::class,'SendOTPCode'])->name('user-send-otp');
Route::post('/user-verify-otp',[UserController::class,'VerifyOTPCode'])->name('user-verify-otp');
Route::post('/user-reset-password',[UserController::class,'ResetPassword'])->middleware([TokenMiddleware::class]);
