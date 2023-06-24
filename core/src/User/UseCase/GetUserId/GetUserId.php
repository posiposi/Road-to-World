<?php

namespace Core\src\User\UseCase\GetUserId;

use Core\src\User\Domain\Models\UserId;
use Core\src\User\UseCase\Ports\GetUserIdQueryPort;

class GetUserId
{
    private $getUserIdPort;

    public function __construct(
        GetUserIdQueryPort $getUserIdPort
    ) {
        $this->getUserIdPort = $getUserIdPort;
    }

    public function execute(): UserId
    {
        return $this->getUserIdPort->getUserId();
    }
}
