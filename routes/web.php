<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactInfoController;
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

    // Form Kontak untuk form aja
    Route::post('/kontak-kami', [ContactInfoController::class, 'storeFormKontak'])->name('storeContact'); //untuk formkontak
    Route::get('/kontak-kami', [HomeController::class, 'kontak'])->name('kontak.show');

    // Logout (hanya bisa diakses setelah login)
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
});

// Admin Routes (akses hanya untuk admin yang terautentikasi)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Rute untuk halaman dashboard admin
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/daftar-berita', [AdminController::class, 'daftarBerita'])->name('admin.daftar-berita');
    Route::get('/daftar-galeri', [AdminController::class, 'daftarGaleri'])->name('admin.daftar-galeri');
    Route::get('/daftar-formkontak', [AdminController::class, 'daftarKontak'])->name('admin.daftar-formkontak');

    // Formulir CRUD Berita
    Route::get('/berita/create', [AdminController::class, 'createBerita'])->name('berita.create');
    Route::post('/berita', [AdminController::class, 'storeBerita'])->name('berita.store');
    Route::get('/berita/{id}/edit', [AdminController::class, 'editBerita'])->name('berita.edit');
    Route::put('/berita/{id}', [AdminController::class, 'updateBerita'])->name('berita.update');
    Route::delete('/berita/{berita}', [AdminController::class, 'destroyBerita'])->name('berita.destroy');

    // Formulir CRUD Galeri
    Route::get('/galeri/create', [AdminController::class, 'createGaleri'])->name('galeri.create');
    Route::post('/galeri', [AdminController::class, 'storeGaleri'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [AdminController::class, 'editGaleri'])->name('galeri.edit');
    Route::put('/galeri/{id}', [AdminController::class, 'updateGaleri'])->name('galeri.update');
    Route::delete('/galeri/{galeri}', [AdminController::class, 'destroyGaleri'])->name('galeri.destroy');

    // Rute untuk Tentang Kami
    Route::get('/admin/edit-tentang', [AdminController::class, 'editTentangKami'])->name('tentang.edit');
    Route::put('/tentang/update', [AdminController::class, 'updateTentangKami'])->name('tentang.update');

    // Rute untuk Kontak Info
    Route::get('/kontak/edit', [ContactInfoController::class, 'editKontak'])->name('kontak.edit');
    Route::put('/kontak/update', [ContactInfoController::class, 'updateKontak'])->name('kontak.update');

    // FORM KONTAK (FormKontak CRUD untuk Admin)
    Route::get('/formkontak/{id}/edit', [ContactInfoController::class, 'editFormKontak'])->name('formkontak.edit');
    Route::put('/formkontak/{id}', [ContactInfoController::class, 'updateFormKontak'])->name('formkontak.update');
    Route::delete('/formkontak/{id}', [ContactInfoController::class, 'destroyFormKontak'])->name('formkontak.destroy');
});
