<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReplyController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ImageOptimizationTestController;


// Authentication routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [PostController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/user/posts', [PostController::class, 'getUsersPosts']);
    Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/test-optimization', [ImageOptimizationTestController::class, 'testOptimization']);

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
    Route::get('/test-notifications', function () {
        $user = \App\Models\User::find(1); // Replace with a valid user ID
        $notification = $user->notifications->last(); // Get the latest notification
    
        return response()->json($notification->data);
    });
    
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

});


//todo : The Email Verification Notice
// Route should be defined that will return a view instructing the user to click the email verification 
// link that was emailed to them by Laravel after registration.
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//todo : The Email Verification Handler
// route that will handle requests generated when the user clicks the email verification link that was emailed to them 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// todo : Resending the Verification Email
//  route to allow the user to request that the verification email be resent.
// (Sometimes a user may misplace or accidentally delete the email address verification email) 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    dd(config('mail.mailers.smtp'));
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//* ***************************************************************************************************************************************
    // Home route
    Route::get('/', [PostController::class, 'getHomePagePosts'])->name('home');
    // Search route
    Route::get('/search', [PostController::class, 'search'])->name('search');
    Route::get('/category/{categoryId}', [PostController::class, 'getPostsByCategory'])->name('category.posts');
    Route::get('/about', [PostController::class, 'aboutUs'])->name('aboutUs');
    Route::get('/help', [PostController::class, 'help'])->name('help');
    
    Route::get('/send-test-email', function () {
        \Illuminate\Support\Facades\Mail::raw('This is a test email.', function ($message) {
            $message->to('fadmaproco@gmail.com')
                    ->subject('Test Email');
        });
        
        return 'Test email sent.';
    });
    

require __DIR__.'/auth.php';