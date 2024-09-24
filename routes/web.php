<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Formulir Registrasi dan Login (tidak memerlukan login)
Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AdminController::class, 'register'])->name('register.post');
Route::get('/login', [HomeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [HomeController::class, 'login'])->name('login.post');

// Rute yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    
    // Halaman Utama (hanya bisa diakses setelah login)
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Halaman Lain
    Route::get('/tentang-kami', [HomeController::class, 'tentang'])->name('tentang');
    Route::get('/berita-kami', [HomeController::class, 'berita'])->name('berita');
    Route::get('/galeri-kami', [HomeController::class, 'galeri'])->name('galeri');
    Route::get('/kontak-kami', [HomeController::class, 'kontak'])->name('kontak');

    // Formulir Kontak
    Route::post('/kontak', [HomeController::class, 'storeContact'])->name('storeContact');

    // Logout (hanya bisa diakses setelah login)
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
});

// Admin Routes (akses hanya untuk admin yang terautentikasi)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');

    // Formulir CRUD Berita
    Route::get('/berita/create', [AdminController::class, 'createBerita'])->name('berita.create');
    Route::post('/berita', [AdminController::class, 'storeBerita'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [AdminController::class, 'editBerita'])->name('berita.edit');
    Route::put('/berita/{berita}', [AdminController::class, 'updateBerita'])->name('berita.update');
    Route::delete('/berita/{berita}', [AdminController::class, 'destroyBerita'])->name('berita.destroy');

    // Formulir CRUD Galeri
    Route::get('/galeri/create', [AdminController::class, 'createGaleri'])->name('galeri.create');
    Route::post('/galeri', [AdminController::class, 'storeGaleri'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [AdminController::class, 'editGaleri'])->name('galeri.edit');
    Route::put('/galeri/{id}', [AdminController::class, 'updateGaleri'])->name('galeri.update');
    Route::delete('/galeri/{galeri}', [AdminController::class, 'destroyGaleri'])->name('galeri.destroy');
    Route::get('/galeri-kami', [AdminController::class, 'showGaleri'])->name('galeri.kami');
});
