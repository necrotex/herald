<?php

namespace nullx27\Herald\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use nullx27\Herald\Helpers\Discord;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $token = $this->app->make('config')->get('services.discord.token');

        $this->app->when(Discord::class)
            ->needs('$token')
            ->give($token);
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
