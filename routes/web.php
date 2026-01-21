<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AuthController;


// --- RUTE HALAMAN UTAMA (REDIRECT) ---
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// --- RUTE AUTHENTICATION (PUBLIC) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTE SURVEY KEPUASAN (PUBLIC - Bisa diakses tamu tanpa login) ---
Route::get('/survey', [TamuController::class, 'survey'])->name('survey');
Route::post('/survey', [TamuController::class, 'kirimSurvey'])->name('survey.kirim');

// --- RUTE YANG MEMBUTUHKAN LOGIN (MIDDLEWARE AUTH) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [TamuController::class, 'dashboard'])->name('dashboard');

    // Fitur Khusus Manajemen Tamu (Monitoring, Cetak, dan Checkout)
    // Diletakkan di atas rute resource agar tidak konflik dengan parameter {tamu}
    Route::get('/tamu/monitoring', [TamuController::class, 'monitoring'])->name('tamu.monitoring');
    Route::get('/tamu/cetak-pdf', [TamuController::class, 'cetakPDF'])->name('tamu.cetak');
    Route::patch('/tamu/{id}/checkout', [TamuController::class, 'checkout'])->name('tamu.checkout');

    // Manajemen Tamu CRUD (Index, Store, Update, Destroy)
    Route::resource('tamu', TamuController::class);

    // Manajemen Ruangan CRUD (Index, Store, Update, Destroy)
    Route::resource('ruangan', RuanganController::class);
    
});