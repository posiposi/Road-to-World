<?php

namespace App\Providers;

use App\Adapters\Bike\DeleteBikeAdapter;
use App\Adapters\Bike\GetAllBikesAdapter;
use App\Adapters\Bike\GetBikeAdapter;
use App\Adapters\Bike\UpdateBikeAdapter;
use App\Adapters\Bike\UpdateBikeImageAdapter;
use App\UseCase\Ports\DeleteBikeCommandPort;
use App\UseCase\Ports\GetAllBikesQueryPort;
use Core\src\Bike\UseCase\Ports\GetBikeQueryPort;
use Core\src\Bike\UseCase\Ports\UpdateBikeCommandPort;
use Core\src\Bike\UseCase\Ports\UpdateBikeImageCommandPort;
use Illuminate\Support\ServiceProvider;
use App\Adapters\Bike\RegisterBikeAdapter;
use Core\src\Bike\UseCase\Ports\RegisterBikeCommandPort;
use Core\src\Bike\UseCase\Ports\UploadBikeImageCommandPort;
use App\Adapters\Bike\UploadBikeImageAdapter;

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
        app()->bind(UpdateBikeImageCommandPort::class, UpdateBikeImageAdapter::class);
        app()->bind(GetBikeQueryPort::class, GetBikeAdapter::class);
        app()->bind(UpdateBikeCommandPort::class, UpdateBikeAdapter::class);
        app()->bind(RegisterBikeCommandPort::class, RegisterBikeAdapter::class);
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
