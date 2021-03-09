<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \Carbon\Carbon::setLocale(LC_TIME, 'en_EN');

        // DB::listen(function ($query) {
        //     var_dump($query->sql);
        //     // var_dump($query->bindings);
        //     // var_dump($query->time);
        // });

        Blade::if('role', function (string $role) {
            return auth()->user()->hasRole($role);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
