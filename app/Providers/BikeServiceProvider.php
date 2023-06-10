<?php

namespace App\Providers;

use App\Adapters\Bike\DeleteBikeAdapter;
use App\Adapters\Bike\GetAllBikesAdapter;
use App\Adapters\Bike\UploadBikeImageAdapter;
use App\UseCase\Ports\DeleteBikeCommandPort;
use Illuminate\Support\ServiceProvider;
use App\UseCase\Ports\GetAllBikesQueryPort;
use Core\src\Bike\UseCase\Ports\UploadBikeImageCommandPort;

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
        app()->bind(UploadBikeImageCommandPort::class, UploadBikeImageAdapter::class);
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
