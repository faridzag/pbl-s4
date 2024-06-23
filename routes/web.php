<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\JPC\CompanyAccountController;
use App\Http\Controllers\JPC\EventManagementController;
use App\Http\Controllers\COMPANY\JobManagementController;
use App\Http\Controllers\COMPANY\JobApplicationController;
use App\Http\Controllers\APPLICANT\JobApplicationController as ApplicantJob;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LandingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/company', [CompanyController::class, 'index'])->name('company');
Route::get('/companies/{company}', [LandingController::class, 'show'])->name('companies.show');
Route::get('/detail-event', function() {
    return view('pages.event.detail-event');
});


Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::get('/register', [RegistrationController::class, 'index'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register']);
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    // Route::resource('basic', BasicController::class);
    Route::resource('company-account', CompanyAccountController::class)->middleware('role-jpc');
    Route::resource('event-management', EventManagementController::class)->middleware('role-jpc');
    Route::resource('job-management', JobManagementController::class)->middleware('role-company');
    Route::resource('job-application', JobApplicationController::class)->middleware('role-company');
    Route::resource('my-job-application', ApplicantJob::class)->middleware('role-applicant');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/blank', function () {
    return view('pages.blank');
})->name('blank');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');