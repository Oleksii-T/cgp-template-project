<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
 *
 * Temporary Dev Routes
 *
 */

Route::get('public', function () {
    // some testing code
    $d = [];

    dd('RESULT', $d);
});

if (!is_dev()) {
    return;
}

Route::get('test', function () {
    // some testing code
    $d = [];

    dd('RESULT', $d);
});

// login in any user by user_id, or into admin user by default
Route::get('login/{user?}', function () {
    $user = request()->user;

    if (!$user) {
        $user = User::whereIn('email', ['admin@mail.com', 'admin@admin.com'])->first();
        if (!$user) {
            // todo add belongsTo relation check
            $user = User::whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->first();
        }
        if (!$user) {
            dump('Admin user not found. Please provide user_id manualy');
            dd(User::all());
        }
    } else {
        $user = User::find($user);
    }

    auth()->login($user);

    return redirect('/');
});

Route::get('phpinfo', function () {
    phpinfo();
});

Route::prefix('emails')->group(function () {
    Route::get('welcome', function () {
        $mail = new \App\Mail\Mail();

        if (request()->email) {
            Mail::to(request()->email)->send($mail);
        }

        return $mail;
    });
});
