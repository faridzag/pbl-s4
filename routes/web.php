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
use App\Http\Controllers\ApplicantProfileController;
use App\Http\Controllers\LandingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/company/{company}', [LandingController::class, 'company_profile'])->name('company.profile');
Route::get('/company-event/{company}', [LandingController::class, 'company_event'])->name('company.event');
Route::get('/event/{event}', [LandingController::class, 'event_show'])->name('event.show');
Route::get('/vacancy/{vacancy}', [LandingController::class, 'vacancy_show'])->name('vacancy.show');
Route::post('/applications', [LandingController::class, 'apply'])->name('apply.job');

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::get('/register', [RegistrationController::class, 'index'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register']);
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::post('/applications', [LandingController::class, 'apply'])->name('apply.job');
    // Route::resource('basic', BasicController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// TODO ROUTE (no show)
Route::middleware(['auth', 'verified', 'role-jpc'])->group(function(){
    Route::resource('company-account', CompanyAccountController::class);
    Route::resource('event-management', EventManagementController::class);
});

Route::middleware(['auth', 'verified', 'role-company'])->group(function(){
    Route::resource('job-management', JobManagementController::class);
    Route::resource('job-application', JobApplicationController::class);
});


Route::middleware(['auth', 'verified', 'role-applicant'])->group(function(){
    Route::get('my-job-application', [ApplicantJob::class, 'index'])->name('my-job-application');
    Route::delete('my-job-application/{id}', [ApplicantJob::class, 'destroy'])->name('my-job-application.destroy');
    Route::get('/applicant-profile', [ApplicantProfileController::class, 'index'])->name('applicant-profile');
    Route::put('/applicant-profile', [ApplicantProfileController::class, 'update'])->name('applicant-profile.update');
});

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