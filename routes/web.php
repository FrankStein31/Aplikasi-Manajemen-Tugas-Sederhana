<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\TugasController as AdminTugas;
use App\Http\Controllers\Admin\ProfileController as AdminProfile;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboard;
use App\Http\Controllers\Karyawan\TugasController as KaryawanTugas;
use Illuminate\Support\Facades\Route;

// ─── Landing ────────────────────────────────────────────────────────────────
Route::get('/', [LandingController::class, 'index'])->name('landing');

// ─── Auth ────────────────────────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Admin ───────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['is_login', 'is_admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile/edit', [AdminProfile::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [AdminProfile::class, 'update'])->name('profile.update');

    // Users
    Route::get('/user', [AdminUser::class, 'index'])->name('user.index');
    Route::post('/user', [AdminUser::class, 'store'])->name('user.store');
    Route::put('/user/{user}', [AdminUser::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [AdminUser::class, 'destroy'])->name('user.destroy');
    Route::get('/user/export/pdf', [AdminUser::class, 'exportPdf'])->name('user.export.pdf');
    Route::get('/user/export/excel', [AdminUser::class, 'exportExcel'])->name('user.export.excel');

    // Tugas
    Route::get('/tugas', [AdminTugas::class, 'index'])->name('tugas.index');
    Route::post('/tugas', [AdminTugas::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{tugas}', [AdminTugas::class, 'show'])->name('tugas.show');
    Route::put('/tugas/{tugas}', [AdminTugas::class, 'update'])->name('tugas.update');
    Route::delete('/tugas/{tugas}', [AdminTugas::class, 'destroy'])->name('tugas.destroy');
    Route::get('/tugas/export/pdf', [AdminTugas::class, 'exportPdf'])->name('tugas.export.pdf');
    Route::get('/tugas/export/excel', [AdminTugas::class, 'exportExcel'])->name('tugas.export.excel');
});

// ─── Karyawan ─────────────────────────────────────────────────────────────────
Route::prefix('karyawan')->name('karyawan.')->middleware(['is_login', 'is_karyawan'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [KaryawanDashboard::class, 'index'])->name('dashboard');

    // Tugas
    Route::get('/tugas', [KaryawanTugas::class, 'index'])->name('tugas.index');
    Route::get('/tugas/cetak-pdf', [KaryawanTugas::class, 'cetakPdf'])->name('tugas.cetak_pdf');
});
