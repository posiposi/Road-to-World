<?php

namespace App\Providers;

use App\Adapters\Bike\GetCommentAdapter;
use Core\src\Comment\UseCase\Ports\GetCommentQueryPort;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(GetCommentQueryPort::class, GetCommentAdapter::class);
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
