<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConsultationController;

Route::get('/', function () {
    return view('home');
});

// Authentication routes
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pasien', PasienController::class);
});

// Doctor only routes
Route::middleware(['auth', 'role:doktor'])->group(function () {
    Route::get('/consultations/doctor', [ConsultationController::class, 'index'])->name('consultations.doctor');
    Route::get('/notifications', [ConsultationController::class, 'notifications'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [ConsultationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/consultations/{consultation}/reply', [ConsultationController::class, 'reply'])->name('consultations.reply');
});

// Patient only routes
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultations.index');
    Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultations.create');
    Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store');
});

// Shared authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/consultations/{consultation}', [ConsultationController::class, 'show'])->name('consultations.show');
});
