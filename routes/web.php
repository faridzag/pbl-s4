<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ApplicantProfileController;
use App\Http\Controllers\JPC\CompanyAccountController;
use App\Http\Controllers\JPC\EventManagementController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\COMPANY\JobManagementController;
use App\Http\Controllers\COMPANY\JobApplicationController;
use App\Http\Controllers\APPLICANT\JobApplicationController as ApplicantJob;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/company/{company}', [LandingPageController::class, 'company_profile'])->name('company.profile');
Route::get('/company-event/{company}', [LandingPageController::class, 'company_event'])->name('company.event');
Route::get('/event/{event}', [LandingPageController::class, 'event_show'])->name('event.show');
Route::get('/vacancy/{vacancy}', [LandingPageController::class, 'vacancy_show'])->name('vacancy.show');
Route::post('/applications', [LandingPageController::class, 'apply'])->name('apply.job');

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::get('/register', [RegistrationController::class, 'index'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register']);
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// TODO ROUTE (no show)
Route::middleware(['auth', 'verified', 'role-jpc'])->group(function(){
    Route::get('company-account', [CompanyAccountController::class, 'index'])->name('company-account.index');
    Route::get('company-account/create', [CompanyAccountController::class, 'create'])->name('company-account.create');
    Route::post('company-account', [CompanyAccountController::class, 'store'])->name('company-account.store');
    Route::get('company-account/{company_account}/edit', [CompanyAccountController::class, 'edit'])->name('company-account.edit');
    Route::put('company-account/{company_account}', [CompanyAccountController::class, 'update'])->name('company-account.update');
    Route::delete('company-account/{company_account}', [CompanyAccountController::class, 'destroy'])->name('company-account.destroy');

    Route::get('event-management', [EventManagementController::class, 'index'])->name('event-management.index');
    Route::get('event-management/create', [EventManagementController::class, 'create'])->name('event-management.create');
    Route::post('event-management', [EventManagementController::class, 'store'])->name('event-management.store');
    Route::get('event-management/{event_management}/edit', [EventManagementController::class, 'edit'])->name('event-management.edit');
    Route::put('event-management/{event_management}', [EventManagementController::class, 'update'])->name('event-management.update');
    Route::delete('event-management/{event_management}', [EventManagementController::class, 'destroy'])->name('event-management.destroy');
});

Route::middleware(['auth', 'verified', 'role-company'])->group(function(){

    Route::get('job-management', [JobManagementController::class, 'index'])->name('job-management.index');
    Route::get('job-management/create', [JobManagementController::class, 'create'])->name('job-management.create');
    Route::post('job-management', [JobManagementController::class, 'store'])->name('job-management.store');
    Route::get('job-management/{job_management}/edit', [JobManagementController::class, 'edit'])->name('job-management.edit');
    Route::put('job-management/{job_management}', [JobManagementController::class, 'update'])->name('job-management.update');
    Route::delete('job-management/{job_management}', [JobManagementController::class, 'destroy'])->name('job-management.destroy');

    Route::get('job-application', [JobApplicationController::class, 'index'])->name('job-application.index');
    Route::get('job-application/create', [JobApplicationController::class, 'create'])->name('job-application.create');
    Route::post('job-application', [JobApplicationController::class, 'store'])->name('job-application.store');
    Route::get('job-application/{job_application}/edit', [JobApplicationController::class, 'edit'])->name('job-application.edit');
    Route::put('job-application/{job_application}', [JobApplicationController::class, 'update'])->name('job-application.update');
    Route::delete('job-application/{job_application}', [JobApplicationController::class, 'destroy'])->name('job-application.destroy');
});

Route::middleware(['auth', 'verified', 'role-applicant'])->group(function(){
    Route::get('my-job-application', [ApplicantJob::class, 'index'])->name('my-job-application');
    Route::delete('my-job-application/{id}', [ApplicantJob::class, 'destroy'])->name('my-job-application.destroy');
    Route::get('/applicant-profile', [ApplicantProfileController::class, 'index'])->name('applicant-profile');
    Route::put('/applicant-profile', [ApplicantProfileController::class, 'update'])->name('applicant-profile.update');
    Route::post('/applications', [LandingPageController::class, 'apply'])->name('apply.job');
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