<?php

namespace App\Providers;

use App\Adapters\User\GetUserAdapter;
use App\Adapters\User\GetUserIdAdapter;
use App\Adapters\User\GetUserNicknameAdapter;
use Core\src\User\UseCase\Ports\GetUserIdQueryPort;
use Core\src\User\UseCase\Ports\GetUserNicknamePort;
use Core\src\User\UseCase\Ports\GetUserQueryPort;
use Illuminate\Support\ServiceProvider;

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
        app()->bind(GetUserQueryPort::class, GetUserAdapter::class);
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
