<?php

namespace Core\src\User\UseCase\Ports;

use Core\src\User\Domain\Models\UserId;

interface GetUserIdQueryPort
{
    public function getUserId(): UserId;
}
