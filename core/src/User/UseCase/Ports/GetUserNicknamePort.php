<?php

namespace Core\src\User\UseCase\Ports;

use Core\src\User\Domain\Models\UserId;
use Core\src\User\Domain\Models\UserNickname;

interface GetUserNicknamePort
{
    public function getUserNickname(UserId $userId): UserNickname;
}
