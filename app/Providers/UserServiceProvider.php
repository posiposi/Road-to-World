<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Adapters\User\GetUserIdAdapter;
use App\Adapters\User\GetUserNicknameAdapter;
use Core\src\User\UseCase\Ports\GetUserIdQueryPort;
use Core\src\User\UseCase\Ports\GetUserNicknamePort;

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
        app()->bind(GetUserNicknamePort::class, GetUserNicknameAdapter::class);
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
