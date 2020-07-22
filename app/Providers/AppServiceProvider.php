<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer(['layouts.partials.sidebar'], function ($view) {
            $user = auth()->user();
            $avatar = asset('assets/img/default-avatar.png');


            $sidebar_image = asset('assets/img/sidebar-1.jpg');

            $color = 'black';
            $btn_color = 'danger';


            $view->with('current_route', Route::current())
                ->with('avatar', $avatar)
                ->with('sidebar_image', $sidebar_image)
                ->with('color', $color)
                ->with('btn_color', $btn_color);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

    }
}
