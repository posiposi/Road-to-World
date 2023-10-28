<?php

namespace Core\src\User\UseCase\Ports;

use Core\src\User\Domain\Models\User;
use Core\src\User\Domain\Models\UserId;

interface GetUserQueryPort
{
    public function findByUserId(UserId $userId): User;
}
