<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function($view) {
            $cashTime = 5;

            $view->with(
                'currentUser',
                auth()->user()
            );

            // $view->with(
            //     'mainMenu',
            //     Cache::remember('mainMenu', $cashTime, function() {
            //         return Menu::where('code', 'main')->first()->items()->with('children')->get();
            //     })
            // );

            // $view->with(
            //     'footerMenu',
            //     Cache::remember('footerMenu', $cashTime, function() {
            //         return Menu::where('code', 'footer')->first()->items()->with('children')->get();
            //     })
            // );

            $view->with(
                'headerBlock',
                Cache::remember('headerBlock', $cashTime, function() {
                    return Page::get('/')->blocks()->where('name', 'header')->first();
                })
            );

            $view->with(
                'footerBlock',
                Cache::remember('footerBlock', $cashTime, function() {
                    return Page::get('/')->blocks()->where('name', 'footer')->first();
                })
            );
        });

        config(['services.google.client_id'=> Setting::get('google_client_id')]);
        config(['services.google.client_secret'=> Setting::get('google_client_secret')]);
        config(['services.google.redirect'=> Setting::get('google_redirect')]);

        config(['services.twitter.client_id'=> Setting::get('twitter_client_id')]);
        config(['services.twitter.client_secret'=> Setting::get('twitter_client_secret')]);
        config(['services.twitter.redirect'=> Setting::get('twitter_redirect')]);

        config(['services.facebook.client_id'=> Setting::get('facebook_client_id')]);
        config(['services.facebook.client_secret'=> Setting::get('facebook_client_secret')]);
        config(['services.facebook.redirect'=> Setting::get('facebook_redirect')]);
    }
}
