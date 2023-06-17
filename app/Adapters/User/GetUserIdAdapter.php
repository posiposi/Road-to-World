<?php

namespace App\Adapters\User;

use Core\src\User\Domain\Models\UserId;
use Core\src\User\UseCase\Ports\GetUserIdQueryPort;
use Illuminate\Support\Facades\Auth;

class GetUserIdAdapter implements GetUserIdQueryPort
{
    public function getUserId(): UserId
    {
        return UserId::of(Auth::id());
    }
}
