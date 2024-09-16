<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public welcome page


// Posts Routes
Route::middleware('auth')->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('posts.index');

    Route::middleware('admin')->group(function () {

        // Creating Post only for the admin usnig the middleware
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

        // Editing Post only for the admin usnig the middleware
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

        // Delete Posts only for the admin
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    });

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    // Comments Routes
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');



    // Profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes (Breeze)
require __DIR__.'/auth.php';
