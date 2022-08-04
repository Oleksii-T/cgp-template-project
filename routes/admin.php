<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SubscriptionPlanController;
use App\Http\Controllers\Admin\SettingController;

/*
 *
 * Routes for admin panel
 *
 */

Route::view('/login', 'admin.auth.login')->name('login');

Route::middleware('is-admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('users', UserController::class);

    Route::resource('subscription-plans', SubscriptionPlanController::class)->except('show');

    Route::resource('subscriptions', SubscriptionController::class)->only(['index', 'show', 'destroy']);

    Route::get('pages/{page}/edit-blocks', [PageController::class, 'editBlocks'])->name('pages.edit-blocks');
    Route::put('pages/{page}/update-blocks', [PageController::class, 'updateBlocks'])->name('pages.update-blocks');
    Route::resource('pages', PageController::class)->except('show');

    Route::prefix('menus')->as('menus.')->group(function () {
		Route::get('/', [MenuController::class, 'index'])->name('index');
		Route::get('edit/{menu}', [MenuController::class, 'edit'])->name('edit');
		Route::post('destroy', [MenuController::class, 'destroy'])->name('destroy');
		Route::post('store', [MenuController::class, 'store'])->name('store');
		Route::post('get-sortable', [MenuController::class, 'get_sortable'])->name('get-sortable');
		Route::post('save-sortable', [MenuController::class, 'save_sortable'])->name('save-sortable');
	});
});
