<?php

namespace Core\src\Bike\UseCase\GetUserBikeList;

use Core\src\Bike\Domain\Models\BikeList;
use Core\src\Bike\UseCase\Ports\GetBikeQueryPort;
use Core\src\User\UseCase\Ports\GetUserIdQueryPort;

class GetUserBikeList
{
    private $getBikePort;
    private $getUserIdPort;

    public function __construct(
        GetBikeQueryPort $getBikePort,
        GetUserIdQueryPort $getUserIdPort
    ) {
        $this->getBikePort = $getBikePort;
        $this->getUserIdPort = $getUserIdPort;
    }

    public function execute(): BikeList
    {
        $userId = $this->getUserIdPort->getUserId();
        return $this->getBikePort->findByUserId($userId);
    }
}
