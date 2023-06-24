<?php

namespace Core\src\Bike\UseCase\Ports;

use Core\src\Bike\Domain\Models\Bike;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Bike\Domain\Models\BikeList;
use Core\src\User\Domain\Models\UserId;

interface GetBikeQueryPort
{
    public function findByBikeId(BikeId $bikeId): Bike;

    public function findByUserId(UserId $userId): BikeList;
}
