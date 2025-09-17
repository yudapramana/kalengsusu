<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use Config;
use DB;
use Auth;
use App\Models\Post;

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

            $now = Carbon::now();
            $year = $now->year;
            $month = $now->month;

            // CACHE: yearly (cache lebih lama), monthly (sedikit lebih pendek), daily (paling pendek)
            $yearly = Cache::remember("homepage_viewer_yearly_{$year}", now()->addHours(12), function () use ($year) {
                return Post::whereYear('created_at', $year)->sum('reads');
            });

            $monthly = Cache::remember("homepage_viewer_monthly_{$year}_{$month}", now()->addHours(2), function () use ($year, $month) {
                return Post::whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('reads');
            });

            // daily — kalau memang mau "per hari" gunakan whereDate; kalau mau "week" ganti sesuai kebutuhan
            $today = $now->toDateString();
            $daily = Cache::remember("homepage_viewer_daily_{$today}", now()->addMinutes(15), function () use ($today) {
                return Post::whereDate('created_at', $today)->sum('reads');
            });

            // Optional: queue cookies (nilai disimpan client-side sebagai fallback)
            // Cookie::queue(name, value, minutes)
            Cookie::queue('homepage_viewer_yearly', $yearly, 60 * 24 * 30);   // 30 days
            Cookie::queue('homepage_viewer_monthly', $monthly, 60 * 24 * 14);  // 14 days
            Cookie::queue('homepage_viewer_daily', $daily, 60 * 24);           // 1 day


            // dd($landingmenuitems);
            $view->with('landingmenuitems', $landingmenuitems);


            $view->with('selectedServices', $selectedServices);
            $view->with('bootCategories', $bootCategories);

            $view->with('locale', $locale);
            $view->with('titleLocale', 'title_' .$locale);

            $view->with('yearly', number_format($yearly, 0, ',', '.'));
            $view->with('monthly', number_format($monthly, 0, ',', '.'));
            $view->with('daily', number_format($daily, 0, ',', '.'));

        });
    }
}
