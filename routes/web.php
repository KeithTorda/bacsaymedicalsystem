<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

// Auth Controller Routes
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('logout/page', 'logoutPage')->name('logout/page');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'storeUser')->name('register');    
    });

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forget-password', 'getEmail')->name('forget-password');
        Route::post('forget-password', 'postEmail')->name('forget-password');    
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'getPassword');
        Route::post('reset-password', 'updatePassword');    
    });
});

// Barangay Bacsay Health Center Routes (Protected by Auth)
Route::middleware('auth')->group(function () {
    // Dashboard & Profile
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::get('/profile', 'profile')->name('profile');
    });

    // Patients Module
    Route::resource('patients', PatientController::class);

    // Consultations
    Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultations.create');
    Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');

    // Medical Records Module
    Route::get('/medical-records', [MedicalRecordController::class, 'index'])->name('medical-records.index');
    Route::get('/medical-records/history', [MedicalRecordController::class, 'history'])->name('medical-records.history');
    Route::get('/medical-records/vitals', [MedicalRecordController::class, 'vitals'])->name('medical-records.vitals');

    // Appointments & Prescriptions
    Route::get('/appointments', function() { return view('appointments.index'); })->name('appointments.index');
    Route::resource('prescriptions', PrescriptionController::class);

    // Reports Module
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/patients', [ReportController::class, 'patients'])->name('reports.patients');

    // Print Module
    Route::get('/print/patient/{id}', [PrintController::class, 'patient'])->name('print.patient');
    Route::get('/print/medical-record/{id}', [PrintController::class, 'medicalRecord'])->name('print.medical-record');
    Route::get('/print/consultation/{id}', [PrintController::class, 'consultation'])->name('print.consultation');
    Route::get('/print/prescription/{id}', [PrintController::class, 'prescription'])->name('print.prescription');
    Route::get('/print/referral/{id}', [PrintController::class, 'referral'])->name('print.referral');

    // Settings & Users
    Route::get('/settings', function() { return view('settings.general'); })->name('settings');
    Route::get('/users', function() { return view('users.index'); })->name('users.index');
});
