<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PenyakitController;
use App\Http\Controllers\Admin\GejalaController;
use App\Http\Controllers\Admin\AturanController; // Controller baru untuk manajemen aturan

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. Rute Publik (Akses Tanpa Login) ---
// Rute untuk beranda dan proses konsultasi pengguna.

Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Informasi Kesehatan
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');

// Halaman Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Halaman Diagnosis (Konsultasi)
Route::get('/diagnosis', [KonsultasiController::class, 'index'])->name('diagnosis.index');

// Grup Rute Konsultasi (Sistem Pakar)
Route::prefix('konsultasi')->group(function () {
    
    // Tampilkan daftar gejala sebagai form konsultasi
    Route::get('/', [KonsultasiController::class, 'index'])->name('konsultasi.start');
    
    // Proses data gejala yang dipilih dan jalankan Forward Chaining
    Route::post('/diagnose', [KonsultasiController::class, 'diagnose'])->name('konsultasi.diagnose');
    
    // Tampilkan hasil diagnosa berdasarkan ID sesi/hasil
    Route::get('/result/{id}', [KonsultasiController::class, 'showResult'])->name('konsultasi.result');
});

// --- 2. Rute Autentikasi ---
// Aktifkan rute login/register/logout bawaan Laravel (jika Anda menggunakan Laravel Breeze/Jetstream/UI)
// Auth::routes(); 

// Simple admin login/logout (non-social)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Public-friendly login routes (compatibility with /login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


// --- 3. Rute Admin (Area Manajemen Basis Pengetahuan) ---
// Rute yang dilindungi. Hanya dapat diakses setelah login (auth) dan memiliki peran admin (admin middleware opsional).
// Pastikan Anda sudah membuat middleware 'auth' dan 'admin' jika diperlukan.

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin (Halaman utama setelah login)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Gejala (CRUD)
    Route::resource('gejala', GejalaController::class);

    // Manajemen Penyakit (CRUD)
    Route::resource('penyakit', PenyakitController::class);

    // Manajemen Aturan (CRUD untuk membuat/mengedit relasi IF-THEN)
    // AturanController akan mengelola data di tabel 'aturan' dan 'aturan_detail'
    Route::resource('aturan', AturanController::class); 
});