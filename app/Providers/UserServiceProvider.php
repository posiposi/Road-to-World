<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Adapters\User\GetUserIdAdapter;
use Core\src\User\UseCase\Ports\GetUserIdQueryPort;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(GetUserIdQueryPort::class, GetUserIdAdapter::class);
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
