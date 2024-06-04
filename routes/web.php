<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\JPCController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AddCompanyController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/add-company', [JPCController::class, 'addCompany'])->name('add-company');
    Route::post('/add-company', [JPCController::class, 'createCompanyAccount']);
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::get('/register', [RegistrationController::class, 'index'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register']);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::controller(EventController::class)->prefix('event')->group(function(){
        Route::get('','index')->name('event');
        Route::get('tambah','tambah')->name('event.tambah');
        Route::post('tambah','simpan')->name('event.tambah.simpan');
        Route::get('edit/{id}','edit')->name('event.edit');
        Route::post('edit/{id}','update')->name('event.tambah.update');
        Route::get('hapus/{id}','hapus')->name('event.hapus');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(CompaniesController::class)->prefix('çompanies')->group(function () {
        Route::get('','index')->name('companies');
        Route::get('tambah','tambah')->name('companies.tambah');
        Route::post('tambah','simpan')->name('companies.tambah.simpan');
        Route::get('edit/{id}','edit')->name('companies.edit');
        Route::post('edit/{id}','update')->name('companies.tambah.update');
        Route::get('hapus/{id}','hapus')->name('companies.hapus');
    });
});

// Route::middleware(['auth', 'verified'])->group(function(){
//     Route::get('/add-company', [CompanyController::class, 'index'])->name('company');
//     Route::get('/add-company/create', [CompanyController::class, 'addCompany'])->name('company.create');
//     Route::post('/add-company/create', [CompanyController::class, 'createCompanyAccount']);
//     Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
//     Route::get('/dashboard', function(){
//         return view('dashboard');
//     })->name('dashboard');
// });
