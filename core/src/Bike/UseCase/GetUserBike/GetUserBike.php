<?php

namespace Core\src\Bike\UseCase\GetUserBike;

use Core\src\Bike\Domain\Models\BikeList;
use Core\src\Bike\UseCase\Ports\GetBikeQueryPort;
use Core\src\User\Domain\Models\UserId;

class GetUserBike
{
    private $getBikePort;

    public function __construct(GetBikeQueryPort $getBikePort)
    {
        $this->getBikePort = $getBikePort;
    }

    public function execute(UserId $userId): BikeList
    {
        return $this->getBikePort->findByUserId($userId);
    }
}
