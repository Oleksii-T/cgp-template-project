<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SocialAuthController;

/*
 *
 * Routes for client side
 *
 */

// Guest
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('how-it-works', [PageController::class, 'howItWorks'])->name('how-it-works');
Route::get('blog', [PageController::class, 'blog'])->name('blog');
Route::get('contact-us', [PageController::class, 'contactUs'])->name('contact-us');
Route::post('contact-us', [PageController::class, 'contactUsStore'])->name('contact-us-store');
Route::get('faq', [PageController::class, 'plans'])->name('faq');
Route::get('plans', [PageController::class, 'plans'])->name('plans');
Route::get('terms', [PageController::class, 'terms'])->name('terms');
Route::get('privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('about-us', [PageController::class, 'aboutUs'])->name('about-us');
Route::get('auth/social/{provider}', [SocialAuthController::class, 'redirect'])->name('auth.social');
Route::get('auth/callback/{provider}', [SocialAuthController::class, 'callback']);

Route::get('about-us', [PageController::class, 'aboutUs'])->name('about-us');

// Logged in
Route::middleware('auth:web')->group(function () {
    Route::get('logout', function () {
        auth()->logout();
        return redirect()->route('index');
    })->name('logout');

    Route::middleware('verified')->group(function () {
        // Verified email

        // Profile
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        // Feedbacks
        Route::get('contact-us', [FeedbackController::class, 'index'])->name('feedbacks.index');
        Route::post('feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');

        // Subscriptions
        Route::resource('subscriptions', SubscriptionController::class)->only('show', 'store');
    });

});
