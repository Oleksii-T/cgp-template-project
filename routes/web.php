<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\BlogController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
 *
 * Routes for client side
 *
 */

// Guest
Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('auth/social/{provider}', [SocialAuthController::class, 'redirect'])->name('auth.social');
Route::get('auth/callback/{provider}', [SocialAuthController::class, 'callback']);

// Subscription Plans
Route::prefix('subscription-plans')->name('subscription-plans.')->group(function () {
    Route::get('/', [SubscriptionPlanController::class, 'index'])->name('index');
});

// Feedbacks
Route::get('contact-us', [FeedbackController::class, 'index'])->name('feedbacks.index');
Route::post('feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');

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

        // Subscription Plans
        Route::prefix('subscription-plans')->name('subscription-plans.')->group(function () {
            Route::get('{subscriptionPlan}/show', [SubscriptionPlanController::class, 'show'])->name('show');
            Route::post('{subscriptionPlan}/subscribe', [SubscriptionPlanController::class, 'subscribe'])->name('subscribe');
        });

        // Subscriptions
        Route::prefix('subscriptions')->name('subscriptions.')->group(function () {
            Route::post('{subscription}/cancel', [SubscriptionController::class, 'cancel'])->name('cancel');
            Route::post('', [SubscriptionController::class, 'store'])->name('store');
            Route::post('payment-method', [SubscriptionController::class, 'paymentMethod'])->name('payment-method');
        });

        // Payment Methods
        Route::prefix('payment-methods')->name('payment-methods.')->group(function () {
            Route::post('', [PaymentMethodController::class, 'store'])->name('store');
            Route::delete('{paymentMethod}', [PaymentMethodController::class, 'destroy'])->name('destroy');
            Route::post('{paymentMethod}', [PaymentMethodController::class, 'setDefault'])->name('set-default');
        });

        // Subscription Stripe
        Route::prefix('stripe')->group(function () {
            Route::post('setup-intent', [StripeController::class, 'setupIntent']);
        });

        Route::middleware(['localeSessionRedirect', 'localizationRedirect'])->prefix(LaravelLocalization::setLocale())->group(function () {
            Route::resource('blogs', Blog::class)->only('index', 'show');
        });
    });

    Route::middleware(['localeSessionRedirect', 'localizationRedirect'])->prefix(LaravelLocalization::setLocale())->group(function () {
        Route::resource('blog', BlogController::class)->only('index', 'show');
    });
});

Route::get('{url}', [PageController::class, 'page'])->name('page');
