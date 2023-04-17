<?php

namespace App\Providers;

use App\Adapters\Bike\DeleteBikeAdapter;
use App\Adapters\Bike\GetAllBikesAdapter;
use App\UseCase\Ports\DeleteBikeCommandPort;
use Illuminate\Support\ServiceProvider;
use App\UseCase\Ports\GetAllBikesQueryPort;

class BikeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(GetAllBikesQueryPort::class, GetAllBikesAdapter::class);
        app()->bind(DeleteBikeCommandPort::class, DeleteBikeAdapter::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
