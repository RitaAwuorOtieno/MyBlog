<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes for your Laravel app are defined here.
| Public pages, auth-protected pages, admin routes, and profile routes.
|
*/

// Public home page (root URL)
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Public blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Dashboard route, protected by auth and email verification
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management routes, requires authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes, all require authentication
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Full resource routes for post management
    Route::resource('posts', PostController::class);

    // Simple views for payments and contacts pages under admin
    Route::view('/payments', 'admin.payments.index')->name('payments');
    Route::view('/contacts', 'admin.contacts.index')->name('contacts');
});

require __DIR__.'/auth.php';
