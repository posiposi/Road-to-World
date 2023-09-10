<?php

namespace Core\src\User\UseCase\GetUserNickname;

use Core\src\User\Domain\Models\UserId;
use Core\src\User\Domain\Models\UserNickname;
use Core\src\User\UseCase\Ports\GetUserNicknamePort;

final class GetUserNickname
{
    private $getUserNicknamePort;

    public function __construct(
        GetUserNicknamePort $getUserNicknamePort
    ) {
        $this->getUserNicknamePort = $getUserNicknamePort;
    }

    public function execute(UserId $userId): UserNickname
    {
        return $this->getUserNicknamePort->getUserNickname($userId);
    }
}
