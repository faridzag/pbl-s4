<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthenticationController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/register', [RegistrationController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegistrationController::class, 'register']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);
