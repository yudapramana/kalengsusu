<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Config;
use DB;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) {
            // all views will have access to current route
            $view->with('current_route', \Route::getCurrentRoute());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        \Carbon\Carbon::setLocale(config('app.locale'));
        // date_default_timezone_set('Asia/Jakarta');

        View::composer('*', function ($view) {

            $locale = app()->getLocale();
            $selectedServices = \App\Models\Services::select('next_url', 'name', 'slug', 'title_id', 'title_en')->where('listed', 'yes')->get();

            $menu = \App\Models\Menu::where('title', 'Header')->first();
            $landingmenuitems = collect([]);
            if($menu && $menu->content != '') {
                $landingmenuitems = json_decode($menu->content);
                $landingmenuitems = $landingmenuitems[0];
            }

            $bootCategories = \App\Models\Category::select('slug', 'title')->get();

            // dd($landingmenuitems);
            $view->with('landingmenuitems', $landingmenuitems);


            $view->with('selectedServices', $selectedServices);
            $view->with('bootCategories', $bootCategories);

            $view->with('locale', $locale);
            $view->with('titleLocale', 'title_' .$locale);
        });
    }
}
