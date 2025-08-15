<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PenjemputanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirect root ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Auth::routes(['register' => false]); // Nonaktifkan registrasi default

// Route khusus registrasi nasabah
Route::get('/register/nasabah', [AuthController::class, 'showNasabahRegisterForm'])->name('register.nasabah');
Route::post('/register/nasabah', [AuthController::class, 'registerNasabah']);

// Redirect setelah login sukses (diatur di LoginController)
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

// Semua route yang membutuhkan authentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Sampah Routes
    Route::resource('sampah', SampahController::class)->except(['show']);
    
    // Transaksi Routes
    Route::resource('transaksi', TransaksiController::class);
    
    // Penjemputan Routes
    Route::resource('penjemputan', PenjemputanController::class);
    
    // nasabah Routes
    Route::resource('nasabah', NasabahController::class);
Route::resource('petugas', PetugasController::class)->middleware('auth');
Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
});


