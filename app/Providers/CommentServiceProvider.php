<?php

namespace App\Providers;

use App\Adapters\Comment\GetCommentAdapter;
use App\Adapters\Comment\SaveCommentAdapter;
use Core\src\Comment\UseCase\Ports\GetCommentQueryPort;
use Core\src\Comment\UseCase\Ports\SaveCommentCommandPort;
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
        app()->bind(SaveCommentCommandPort::class, SaveCommentAdapter::class);
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
