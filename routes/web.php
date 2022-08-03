<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;

/*
 *
 * Routes for client side
 *
 */

// Guest
Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('plans', [PageController::class, 'plans'])->name('plans');
Route::get('terms', [PageController::class, 'terms'])->name('terms');
Route::get('privacy', [PageController::class, 'privacy'])->name('privacy');
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

        // Subscriptions
        Route::resource('subscriptions', SubscriptionController::class)->only('show', 'store');
    });

});
