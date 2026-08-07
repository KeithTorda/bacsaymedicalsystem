<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

// Auth Controller Routes
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('logout/page', 'logoutPage')->name('logout/page');
    });

    Route::get('/register', function() {
        return redirect()->route('login');
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
        Route::post('/profile', 'updateProfile')->name('profile.update');
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
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::post('/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::resource('prescriptions', PrescriptionController::class);

    // Notifications Module
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');

    // Reports Module
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/patients', [ReportController::class, 'patients'])->name('reports.patients');

    // Print Module
    Route::get('/print', [PrintController::class, 'index'])->name('print.index');
    Route::get('/print/patient/{id?}', [PrintController::class, 'patient'])->name('print.patient');
    Route::get('/print/medical-record/{id?}', [PrintController::class, 'medicalRecord'])->name('print.medical-record');
    Route::get('/print/consultation/{id?}', [PrintController::class, 'consultation'])->name('print.consultation');
    Route::get('/print/prescription/{id?}', [PrintController::class, 'prescription'])->name('print.prescription');
    Route::get('/print/referral/{id?}', [PrintController::class, 'referral'])->name('print.referral');

    // Settings & Users Module (Admin Only)
    Route::get('/settings', function() {
        if (auth()->check() && strtolower(auth()->user()->role_name ?? '') !== 'admin') {
            return redirect()->route('home')->with('error', 'Unauthorized Access! Only System Administrators can access System Settings.');
        }
        return view('settings.general');
    })->name('settings');

    Route::post('/settings', function(\Illuminate\Http\Request $request) {
        if (auth()->check() && strtolower(auth()->user()->role_name ?? '') !== 'admin') {
            return redirect()->route('home')->with('error', 'Unauthorized Access! Only System Administrators can modify System Settings.');
        }
        return redirect()->back()->with('success', 'System Settings Updated Successfully!');
    })->name('settings.update');

    Route::resource('users', UserController::class);
    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
});
