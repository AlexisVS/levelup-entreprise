<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // je pense que c'est plus dans event service provider
    // doc exemple
    // protected $listen = [
    //     OrderShipped::class => [
    //         SendShipmentNotification::class,
    //     ],
    // ];

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
        //
    }
}
