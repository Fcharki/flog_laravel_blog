<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // reviews and replies routes
    Route::post('/posts/{post}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{review}/replies', [ReplyController::class, 'store'])->name('replies.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::delete('/replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy');
    // Reviews
    Route::get('reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

    // Replies
    Route::get('replies/{reply}/edit', [ReplyController::class, 'edit'])->name('replies.edit');
    Route::put('replies/{reply}', [ReplyController::class, 'update'])->name('replies.update');

    // route for users' likes
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    // route for notifications
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

});

// * ***************************************************************************************************************************************
// Home route
Route::get('/', [PostController::class, 'getHomePagePosts'])->name('home');
// Search route
Route::get('/search', [PostController::class, 'search'])->name('search');
Route::get('/category/{categoryId}', [PostController::class, 'getPostsByCategory'])->name('category.posts');
Route::get('/about', [PostController::class, 'aboutUs'])->name('aboutUs');
Route::get('/help', [PostController::class, 'help'])->name('help');

require __DIR__.'/auth.php';
