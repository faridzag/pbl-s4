<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\JPCController;
use App\Http\Controllers\JPC\JpcCompanyController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AddCompanyController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::middleware(['guest'])->group(function(){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::get('/register', [RegistrationController::class, 'index'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register']);
});

Route::middleware(['auth', 'verified'])->group(function(){
    //Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('role-check:JPC');
    //Route::get('/dashboard/company', [DashboardController::class, 'index'])->name('company-dashboard');
    //Route::get('/dashboard/user', [DashboardController::class, 'index'])->name('user-dashboard');
    // TO DELETE Route::get('/add-company', [JPCController::class, 'addCompany'])->name('add-company');
    // TO DELETE Route::post('/add-company', [JPCController::class, 'createCompanyAccount']);
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::resource('basic', BasicController::class);
    Route::resource('company-account', JpcCompanyController::class);
});
    Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/blank', function () {
    return view('pages.blank');
})->name('blank');

Route::middleware('auth')->group(function() {
});

Route::resources([
    'events' => EventController::class,
]);

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


// tag to fix
Route::middleware('auth')->group(function () {
    Route::controller(EventsController::class)->prefix('event')->group(function(){
        Route::get('','index')->name('event');
        Route::get('tambah','tambah')->name('event.tambah');
        Route::post('tambah','simpan')->name('event.tambah.simpan');
        Route::get('edit/{id}','edit')->name('event.edit');
        Route::post('edit/{id}','update')->name('event.tambah.update');
        Route::get('hapus/{id}','hapus')->name('event.hapus');
    });
});

// tag to fix
Route::middleware('auth')->group(function () {
    Route::controller(CompaniesController::class)->prefix('companies')->group(function () {
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

// tag to fix
// ROUTE UNTUK DASHBOARD PERUSAHAAN
Route::get('/dasbor', function () {
    return view('dashboard-company');
})->name('dasbor');

// tag to fix
// ROUTE UNTUK LOWONGAN PERUSAHAAN
Route::get('/lowongan', function () {
    return view('job-vacancy.index');
})->name('lowongan');

// tag to fix
// ROUTE UNTUK TAMBAH LOWONGAN PERUSAHAAN
Route::get('/add-vacancy', function () {
    return view('job-vacancy.add-vacancy');
})->name('add-vacancy');

