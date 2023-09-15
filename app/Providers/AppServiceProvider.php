<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
            $user = auth()->user();

            $view->with(
                'currentUser',
                auth()->user()
            );

            $view->with(
                'headerMenu',
                Cache::remember('headerMenu', $cashTime, function() {
                    return Menu::where('code', 'header')->first()->items()->with('children')->get();
                })
            );

            $view->with(
                'footer1Menu',
                Cache::remember('footer1Menu', $cashTime, function() {
                    return Menu::where('code', 'footer-1')->first()->items()->with('children')->get();
                })
            );

            $view->with(
                'footer2Menu',
                Cache::remember('footer2Menu', $cashTime, function() {
                    return Menu::where('code', 'footer-2')->first()->items()->with('children')->get();
                })
            );

            $view->with(
                'footer3Menu',
                Cache::remember('footer3Menu', $cashTime, function() {
                    return Menu::where('code', 'footer-3')->first()->items()->with('children')->get();
                })
            );

            $view->with(
                'footerBottom',
                Cache::remember('footerBottom', $cashTime, function() {
                    return Menu::where('code', 'footer-bottom')->first()->items()->with('children')->get();
                })
            );

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

            $data = [
                'csrf' => csrf_token(),
                'route_name' => \Route::currentRouteName(),
                'translations' => [],
                // some more public data to use in JS
            ];
            if ($user) {
                $data['user'] = [
                    'name' => $user->name,
                    'email' => $user->email
                ];
            }
            $view->with('LaravelDataForJS', $data);
        });

        \Blade::directive('svg', function($arguments) {
            // Funky madness to accept multiple arguments into the directive
            list($path, $class) = array_pad(explode(',', trim($arguments, "() ")), 2, '');
            $path = trim($path, "' ");
            $class = trim($class, "' ");

            // Create the dom document as per the other answers
            $svg = new \DOMDocument();
            $svg->load(public_path($path));
            $svg->documentElement->setAttribute("class", $class);
            $output = $svg->saveXML($svg->documentElement);

            return $output;
        });

        Collection::macro('paginate', function($perPage, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage), // $items
                $this->count(),                  // $total
                $perPage,
                $page,
                [                                // $options
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
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
