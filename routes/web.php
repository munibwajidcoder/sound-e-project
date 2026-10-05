<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMusicController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCategoryController;

// ========================
// PUBLIC ROUTES
// ========================

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Music
Route::get('/music', [MusicController::class, 'index'])->name('music.index');
Route::get('/music/{id}', [MusicController::class, 'show'])->name('music.show');

// Albums
Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');

// Video
Route::get('/video', [VideoController::class, 'index'])->name('video.index');
Route::get('/video/{id}', [VideoController::class, 'show'])->name('video.show');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// ========================
// AUTH ROUTES (Guest Only)
// ========================
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ========================
// AUTHENTICATED USER ROUTES
// ========================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // Reviews (Add/Modify per SRS)
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// ========================
// ADMIN ROUTES
// ========================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Admin Music CRUD
    Route::get('/music', [AdminMusicController::class, 'index'])->name('music.index');
    Route::get('/music/create', [AdminMusicController::class, 'create'])->name('music.create');
    Route::post('/music', [AdminMusicController::class, 'store'])->name('music.store');
    Route::get('/music/{id}/edit', [AdminMusicController::class, 'edit'])->name('music.edit');
    Route::put('/music/{id}', [AdminMusicController::class, 'update'])->name('music.update');
    Route::delete('/music/{id}', [AdminMusicController::class, 'destroy'])->name('music.destroy');

    // Admin Video CRUD
    Route::get('/video', [AdminVideoController::class, 'index'])->name('video.index');
    Route::get('/video/create', [AdminVideoController::class, 'create'])->name('video.create');
    Route::post('/video', [AdminVideoController::class, 'store'])->name('video.store');
    Route::get('/video/{id}/edit', [AdminVideoController::class, 'edit'])->name('video.edit');
    Route::put('/video/{id}', [AdminVideoController::class, 'update'])->name('video.update');
    Route::delete('/video/{id}', [AdminVideoController::class, 'destroy'])->name('video.destroy');

    // Admin Categories CRUD
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Admin Users CRUD
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});
