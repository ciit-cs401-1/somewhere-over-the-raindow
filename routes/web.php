<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Single resource routes for posts, categories, and tags (auth handled in controllers)
Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('posts.search');
Route::resource('posts', App\Http\Controllers\PostController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('tags', App\Http\Controllers\TagController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-create', function () {
    return 'Test route works!';
})->middleware('auth');

require __DIR__.'/auth.php';
