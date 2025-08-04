<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

// Home page - show blog posts
Route::get('/', [PostController::class, 'index'])->name('home');

// Blog routes
Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);
